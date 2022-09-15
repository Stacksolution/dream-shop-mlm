<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utility\ActivetionUtility;
use App\Utility\CashfreeUtility;
use App\Models\BankAccount;

class BnakAccountController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    /**
     * Show the application bank accounts list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        $bank = BankAccount::query();
        if(Auth()->user()->user_type !="admin"){
           $bank->where('bank_user_id',Auth()->user()->id); 
        }
        $status = '';
        if($request->has('status')){
           $status = $request->status;
           $bank->where('bank_status',$status);
        }
        $keyword = '';
        if($request->has('search')){
           $keyword = $request->search;
           $bank->where(function ($q) use ($keyword){
                $q->orWhere('bank_account_holder', 'like', '%'.$keyword.'%')
                ->orWhere('bank_mobile_number', 'like', '%'.$keyword.'%')
                ->orWhere('bank_email', 'like', '%'.$keyword.'%');
            });
        }
        $bank->orderBy('id','desc');
        $bank = $bank->paginate(9);
        return view('back-end.bankaccount.index',compact('bank','keyword','status'));
    }
     /**
     * Show the application bank accounts list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request){
          $bank = BankAccount::query();
          $bank->where('bank_user_id',$request->bank);
          $status = '';
            if($request->has('status')){
               $status = $request->status;
               $bank->where('bank_status',$status);
            }
            $keyword = '';
            if($request->has('search')){
               $keyword = $request->search;
               $bank->where(function ($q) use ($keyword){
                    $q->orWhere('bank_account_holder', 'like', '%'.$keyword.'%')
                    ->orWhere('bank_mobile_number', 'like', '%'.$keyword.'%')
                    ->orWhere('bank_email', 'like', '%'.$keyword.'%');
                });
            }
          $bank->orderBy('id','desc');
          $bank = $bank->paginate(9);
        return view('back-end.bankaccount.index',compact('bank','keyword','status'));
    }   
    /**
     * this method use for show bank form 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request){
        return view('back-end.bankaccount.create');
    }   
    /**
     * this method use for save bank details 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request){
        
        $validated = $request->validate([
            'bank_name' => 'required|min:2|string',
            'name' => 'required|string',
            'mobile' => 'required|min:10',
            'account_number' => 'required',
            'ifsc'=>'required',
            'account_address'=>'required',
            'bank_email'=>'required|email'
        ]);
        
        $checkAccount = BankAccount::where('bank_account_number',$request->bank);
        if($checkAccount->count() > 0){
            $checkAccount = BankAccount::findOrFail($checkAccount->first()->id);
        }else{
            $account = new BankAccount();
        }
        
        $account->bank_name = $request->bank_name;
        $account->bank_email = $request->bank_email;
        $account->bank_account_number = $request->account_number;
        $account->bank_account_holder = $request->name;
        $account->bank_ifsc = $request->ifsc;
        $account->bank_mobile_number = $request->mobile;
        $account->bank_mobile_number = $request->mobile;
        $account->bank_address = $request->account_address;
        $account->bank_is_default = 1;
        $account->bank_user_id = Auth()->user()->id;
        
        
        $beneficiary = CashfreeUtility::get_beneficiary($request);
        if(!empty($beneficiary)){
           $account->bank_beneficiary = $beneficiary;
           $account->bank_status = 1;
        }else{
            $beneficiary = CashfreeUtility::create_beneficiary($request);
            if(!empty($beneficiary)){
                $account->bank_beneficiary = $beneficiary;
                $account->bank_status = 1;
            }
        }
        
        if($account->save()){
            \Session::flash('success','Bank Account added successfully !');
            return back();
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
    public function update(Request $request){
        $validated = $request->validate([
            'bank_name' => 'required|min:2|string',
            'name' => 'required|string',
            'mobile' => 'required|min:10',
            'account_number' => 'required',
            'ifsc'=>'required',
            'account_address'=>'required',
            'bank_email'=>'required|email'
        ]);
        $account = BankAccount::findOrFail($request->bank);
        $account->bank_name = $request->bank_name;
        $account->bank_account_number = $request->account_number;
        $account->bank_account_holder = $request->name;
        $account->bank_ifsc = $request->ifsc;
        $account->bank_mobile_number = $request->mobile;
        $account->bank_address = $request->account_address;
        $account->bank_is_default = 1;
        
        $beneficiary = CashfreeUtility::get_beneficiary($request);
        if(!empty($beneficiary)){
           $account->bank_beneficiary = $beneficiary;
           $account->bank_status = 1;
        }else{
            $beneficiary = CashfreeUtility::create_beneficiary($request);
            if(!empty($beneficiary)){
                $account->bank_beneficiary = $beneficiary;
                $account->bank_status = 1;
            }
        }

        if($account->save()){
            \Session::flash('success','Bank Account updated successfully !');
            return redirect()->route('bank.index');
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
    }   

    /**
     * this method use for edit bank details 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit (Request $request){
        $account = BankAccount::findOrFail($request->bank);
        return view('back-end.bankaccount.edit',compact('account'));
    } 
    /**
     * this method use for update bank details 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Request $request){
        $account = BankAccount::findOrFail($request->bank);
        BankAccount::destroy($account->id);
        \Session::flash('success','Bank account removed successfully !');
        return back();
    } 

    /**
     * this method use for update bank status 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function status_update(Request $request){
        $account = BankAccount::findOrFail($request->bank);
        $account->bank_status = $request->status;
        if($account->save()){
            \Session::flash('success','Bank Account updated successfully !');
            return back();
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
    }   
}