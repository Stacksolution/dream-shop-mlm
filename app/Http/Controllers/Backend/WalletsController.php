<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customers;
use App\Models\Wallets;
use App\Models\PaymentLog;
use Illuminate\Support\Str;
use App\Utility\PoolsUtility;
use App\Utility\CommissionUtility;

class WalletsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('activation');
    }
    /**
     * Show the application back office wallets by users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {  
       $wallet = Wallets::query();
       $wallet->where('wallet_user_id',Auth()->user()->id);
       $wallet->orderBy('id','desc');
       $wallets = $wallet->paginate(10);
       return view('back-end.wallets.wallets-transaction',compact('wallets'));
    }
    /**
     * Show the wallets 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request)
    {   
        $customer = User::findOrFail($request->wallet);
        $balance = Wallets::balance($request->wallet);
        $withdraw = Wallets::withdraw($request->wallet);
        $overall = Wallets::overall($request->wallet);

        return view('back-end.wallets.wallets-page',
            compact(
                'customer','balance','withdraw','overall'
            )
        );
    }
    /**
     * delete wallets
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Request $request)
    {   
        
    }
    /**
     * payment by wallets and active plans
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function plan_payment(Request $request){
        if($request->plan == 'level'){
            $check = LevelMatrixCustomer::where('level_user_id',$request->id)->count();
            if($check > 0){
              \Session::flash('error','Your ID already active in level plans!');  
              return back();
            }
            //check balance
            $balance = Wallets::balance($request->id);
            
            if($balance <= 300){
              \Session::flash('error','Insufficient wallet balance !');  
              return back();
            }

            $orderId = Str::random(10);

            $payment = new PaymentLog();
            $payment->payment_amount  = 300;
            $payment->payment_user_id = $request->id;
            $payment->payment_details = json_encode(['orderAmount'=>300,'orderId'=>$orderId,'paymentMode'=>'Wallets','txTime'=>date('Y-m-d H:i:s')]);
            $payment->payment_status = '1';
            $payment->payment_type = '1';
            $payment->payment_uses = 'level_active_wallets';

            if(Wallets::where('wallet_transaction_id',$orderId)->count() > 0){
                \Session::flash('success','Oops something went wrong !');
                return redirect()->route('back.office');
            }
            

            $payment->save();
            WalletsController::level_payment($request);

            $wallet = new Wallets();
            $wallet->wallet_uses    = 'level_active';
            $wallet->wallet_type    = 0;// One means credit and Zero means Debit
            $wallet->wallet_user_id = $request->id;
            $wallet->wallet_transaction_id = $orderId;
            $wallet->wallet_description = "By activating level plan, Rs.300 rupees debit off your wallet !";
            $wallet->wallet_status = 1;
            $wallet->wallet_amount = 300;
            $wallet->save();
        }

        \Session::flash('success','Payment success !');
        return redirect()->route('back.office');
    }
    /**
     * This method use for active level income user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function level_payment(Request $request){
        $user = User::findOrFail($request->id);
        $parent = User::where('user_referral',$user->user_referral_by)->first();

        $level = new LevelMatrixCustomer();
        $level->level_user_id = $user->id;
        $level->level_parent_id = $parent->id;
        $level->level_uniq_number = time();
        $level->save();

        CommissionUtility::level_income_commission($user);
        CommissionUtility::level_direct_commission($user);
    }
    /**
     * Show the application back office wallets by users id for admin end.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function transactions(Request $request)
    {  
       $wallet = Wallets::query();
       $wallet->where('wallet_user_id',$request->id);
       $wallet->orderBy('id','desc');
       $wallets = $wallet->paginate(10);

       $user_id = $request->id;
       return view('back-end.wallets.wallets-transaction',compact('wallets','user_id'));
    }
    /**
     * Show the application back office wallets dr and cr
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function debitcredit(Request $request)
    {  
       $balance = Wallets::balance($request->id);
       $user = User::findOrFail($request->id);
       return view('back-end.wallets.wallets-debit-credit',compact('user','balance'));
    }

    /**
     * This method use for store wallet
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {  
        $validated = $request->validate([
            'user_id' => 'required',
            'transaction_type' => 'required',
            'amount' => 'required|numeric',
        ]);

        $wallet = new Wallets();
        $wallet->wallet_uses    = 'manual_debit_credit';
        $wallet->wallet_type    = $request->transaction_type;// One means credit and Zero means Debit
        $wallet->wallet_user_id = $request->user_id;
        $wallet->wallet_transaction_id = time();
        if($request->transaction_type == 1){
            $wallet->wallet_description = "Cedit by ".env('APP_NAME').", Rs.".$request->amount." off your wallet !";
        }else{
            $wallet->wallet_description = "Debit by ".env('APP_NAME').", Rs.".$request->amount." off your wallet !";
        }
        
        $wallet->wallet_status = 1;
        $wallet->wallet_amount = $request->amount;        
        if($wallet->save()){
            \Session::flash('success',$wallet->wallet_description);
        }else{
            \Session::flash('error','Oops something went wrong !');
        }
        return back();
    }
    /**
     * Show the application back office for recharge
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function recharge(Request $request)
    {  
       $balance = Wallets::balance(Auth()->user()->id);
       return view('back-end.wallets.wallets-recharge',compact('balance'));
    }
}
