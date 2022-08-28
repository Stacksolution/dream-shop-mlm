<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customers;
use App\Models\Wallets;
use App\Models\PaymentLog;
use App\Models\LevelMatrixCustomer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Utility\PoolsUtility;
use App\Utility\CommissionUtility;
use App\Models\Coins;

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
       //return view('back-end.customer.wallets-page');
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
        $coins = Coins::balance($request->wallet);
        
        $wallets = Wallets::where('wallet_user_id',$request->wallet)->orderBy('id','desc')->paginate(10);
        return view('back-end.wallets.wallets-page',compact('customer','balance','wallets','withdraw','overall','coins'));
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
        //check balance
        $balance = Wallets::balance($request->id);
        if($balance <= 50){
          \Session::flash('error','Insufficient wallet balance !');  
          return redirect()->route('back.office');
        }

        if($request->plan == 'level'){
            $payment = new PaymentLog();
            $payment->payment_amount  = 200;
            $payment->payment_user_id = $request->id;
            $payment->payment_details = json_encode(['orderAmount'=>200,'orderId'=>time(),'paymentMode'=>'Wallets','txTime'=>date('Y-m-d H:i:s')]);
            $payment->payment_status = '1';
            $payment->payment_type = '1';
            $payment->payment_uses = 'level_active_wallets';
            $payment->save();
            WalletsController::level_payment($request);

            $wallet = new Wallets();
            $wallet->wallet_uses    = 'level_active';
            $wallet->wallet_type    = 0;// One means credit and Zero means Debit
            $wallet->wallet_user_id = $request->id;
            $wallet->wallet_transaction_id = time();
            $wallet->wallet_description = "By activating level plan, Rs.200 rupees debit off your wallet !";
            $wallet->wallet_status = 1;
            $wallet->wallet_amount = 200;
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

}
