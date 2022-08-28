<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utility\ActivetionUtility;
use App\Models\BankAccount;
use App\Models\Withdraw;
use App\Models\Wallets;
use Illuminate\Support\Str;
use App\Utility\CashfreeUtility;

class PayoutController extends Controller
{
	public function index(Request $request){
		$withdraw = Withdraw::query();
		if(Auth()->user()->user_type !="admin"){
           $withdraw->where('withdraw_user_id',Auth()->user()->id);
        }

        $to = ''; $from = '';
        if($request->has('to_date') && $request->has('from_date')){
           $from = $request->from_date;	
           $to = $request->to_date;
           $withdraw->where('created_at','>=',$from);
           $withdraw->where('created_at','<=',$to);
        }

        $withdraw->orderBy('id','desc');
		$withdraw = $withdraw->paginate(10);
		return view('back-end.payout.index',compact('withdraw','from','to'));
	}

	public function create(Request $request){
		$bank = BankAccount::where('bank_status','1')->where('bank_user_id',Auth()->user()->id)->get();
		return view('back-end.payout.manul-payout',compact('bank'));
	}

	public function store(Request $request){
		$validated = $request->validate([
            'bank' => 'required',
            'amount' => 'required'
        ]);

		$wallets = Wallets::balance(Auth()->User()->id);
		if(($wallets - 99) <= $request->amount){
			\Session::flash('error','Oops insufficient balance !');
            return back();
		}

		$checks = Withdraw::where('withdraw_user_id',Auth()->user()->id)->where('withdraw_status','0')->count();
		if($checks > 0){
			\Session::flash('error','Oops Your withdrawal request is already pending please wait some time for create new withdrawal request !');
            return back();
		}
        
        $bank = BankAccount::findOrFail($request->bank);
        
        $withdraw = new Withdraw();
        $withdraw->withdraw_amount = $request->amount;
        $withdraw->withdraw_bank_id = $request->bank;
        $withdraw->withdraw_bank = $bank;
        $withdraw->withdraw_user_id = Auth()->user()->id;
        $withdraw->withdraw_transaction_id = Str::random(10);
        $withdraw->withdraw_status = 0;
        $withdraw->withdraw_tds_charge = $request->amount / 100 * 5;
	    $withdraw->withdraw_tds_rate = 5;
	    $withdraw->withdraw_service_charge = $request->amount / 100 * 10;
	    $withdraw->withdraw_service_rate = 10;
        
        $request['bank_beneficiary'] = $bank->bank_beneficiary;
        $request['transferAmount']   = $request->amount - $withdraw->withdraw_tds_charge - $withdraw->withdraw_service_charge;
        $request['transaction_id']   = $withdraw->withdraw_transaction_id;
        $apiresponse = CashfreeUtility::requestTransfer($request);
        
        if($apiresponse == true){
            $wallet = new Wallets();
	        $wallet->wallet_uses    = 'cash_withdraw';
	        $wallet->wallet_type    = 0;// One means credit and Zero means Debit
	        $wallet->wallet_user_id = Auth()->user()->id;
	        $wallet->wallet_transaction_id = $withdraw->withdraw_transaction_id;
	        $wallet->wallet_description = "Debit Rs.".$withdraw->withdraw_amount." by request withdraw !";
	        $wallet->wallet_status = 1;
	        $wallet->wallet_amount = $withdraw->withdraw_amount;
	        $wallet->wallet_tds_charge = $withdraw->withdraw_tds_charge;
	        $wallet->wallet_tds_rate = $withdraw->withdraw_tds_rate;
	        $wallet->wallet_service_charge = $withdraw->withdraw_service_charge;
	        $wallet->wallet_service_rate = $withdraw->withdraw_service_rate;
	        $wallet->save();
	        //status =====
	        $withdraw->withdraw_status = 1;
        }
        
        
        if($withdraw->save()){
            \Session::flash('success','Payout request successfully saved !');
            return redirect()->route('payout.index');
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
	}

	public function show(Request $request){
        dd($request->all());
	}

	public function status_update(Request $request){
		$withdraw = Withdraw::findOrFail($request->payout);
		$withdraw->withdraw_status = $request->status;
		if($withdraw->save()){

			$wallet = new Wallets();
	        $wallet->wallet_uses    = 'cash_withdraw';
	        $wallet->wallet_type    = 0;// One means credit and Zero means Debit
	        $wallet->wallet_user_id = $withdraw->withdraw_user_id;
	        $wallet->wallet_transaction_id = Str::random(10);
	        $wallet->wallet_description = "Debit Rs.".$withdraw->withdraw_amount." by manul withdraw !";
	        $wallet->wallet_status = 1;
	        $wallet->wallet_amount = $withdraw->withdraw_amount;
	        $wallet->wallet_tds_charge = $withdraw->withdraw_amount / 100 * 5;
	        $wallet->wallet_tds_rate = 5;
	        $wallet->wallet_service_charge = $withdraw->withdraw_amount / 100 * 10;
	        $wallet->wallet_service_rate = 10;
	        $wallet->save();

            \Session::flash('success','Payout request successfully approved !');
            return redirect()->route('payout.index');
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
	}	

	/**
     * this method use for update bank details 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Request $request){
        $withdraw = Withdraw::findOrFail($request->payout);
        Withdraw::destroy($withdraw->id);
        \Session::flash('success','withdraw request removed successfully !');
        return back();
    } 
}