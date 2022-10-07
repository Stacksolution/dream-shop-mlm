<?php

namespace App\Http\Controllers\Backend;

use Artisan;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\OrderController;
use Illuminate\Http\Request; 
use Illuminate\Support\Str;   
use App\Models\PaymentLog;
use App\Models\User;
use App\Models\ActivationWallet;
use App\Utility\CommissionUtility;
use App\Utility\PoolsUtility;
use App\Models\Order;
use App\Models\Wallets;

class CashfreeController extends Controller{
    //
    public function online_pay(Request $request){
        
        $orderAmount = 2100;
        if($request->plan == 'binary'){
            //To do
        }else if($request->plan == 'level'){    
            //To do
        }else if($request->plan == 'pool'){ 
            $user = User::find($request->id);
            //check level plan
            $check_pool = User::where('id',$request->id)->where('user_id_status','1')->count();
            if($check_pool > 0){
              \Session::flash('error','Your ID already active in pool plans!');  
              return redirect()->route('back.office');
            }
        }

        $payment = array( 
          "appId" => env('APP_ID'), 
          "orderId" => Str::random(10), 
          "orderAmount" => $orderAmount, 
          "orderCurrency" => "INR", 
          "orderNote" => "", 
          "customerName" => $user->name, 
          "customerPhone" => $user->user_mobile, 
          "customerEmail" => $user->email,
          "returnUrl" => Route('payment.success',[
            $request->id,//thi is a user id 
            $request->plan//this is plan name
        ]), 
          "notifyUrl" => 'https://icquickpayment.com/',
        );
        return view('back-end.payment.cashfree.paymant-form',compact('payment'));
    }

    /**
     * This method use for payment for id activation 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function payment_success(Request $request){
        Artisan::call('cache:clear');
        if($request->plan == 'level'){
            //active and serving commition level income 
        }else if($request->plan == 'pool'){
            //active and serving commition pool income 
            CashfreeController::pool_payment($request);
        }

        if($request->txStatus == 'SUCCESS'){
            \Session::flash('success','Payment success !');
        }else{
            \Session::flash('error','Payment failure !');
        }
        return redirect()->route('back.office');
    }
    /**
     * This method use for active pool income user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public static function pool_payment(Request $request){
        $user = User::findOrFail($request->user_id);
        if($request->txStatus == 'SUCCESS'){

            $user->user_id_status = 1;
            $user->save();
            //FOR ADD IN POOL A MEMBERS
            PoolsUtility::pool_matrix_customers_create($user);

            $payment = new PaymentLog();
            $payment->payment_amount  = $request->orderAmount;
            $payment->payment_user_id = $request->user_id;
            $payment->payment_details = json_encode($request->all());
            $payment->payment_status = '1';
            $payment->payment_type = '1';
            $payment->payment_uses = 'level_active_online';
            $payment->save();

            if(Wallets::where('wallet_transaction_id',$request->orderId)->count() <= 0){
                //wallet or commition utility
                CommissionUtility::direct_level_income($user,$request->orderId);
                
                $active = new ActivationWallet();
                $active->active_amount  = $request->orderAmount;
                $active->active_orderid = $request->orderId;
                $active->active_user_id = $request->user_id;
                $active->save();
            }
        } 
    }
    /**
     * This method use for recharge wallets
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function recharge(Request $request){
        $validated = $request->validate([
            'amount' => 'required',
        ]);

        $user = Auth()->user();
        $payment = array( 
          "appId" => env('APP_ID'), 
          "orderId" => Str::random(10), 
          "orderAmount" => $request->amount, 
          "orderCurrency" => "INR", 
          "orderNote" => "", 
          "customerName" => $user->name, 
          "customerPhone" => $user->user_mobile, 
          "customerEmail" => $user->email,
          "returnUrl" => Route('recharge.success'), 
          "notifyUrl" => 'https://icquickpayment.com/',
        );
        return view('back-end.payment.cashfree.paymant-form',compact('payment'));
    }

    /**
     * This method use for recharge wallets success
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function recharge_success(Request $request){
        if($request->txStatus == 'SUCCESS'){

            $wallet = new Wallets();
            $wallet->wallet_uses    = 'online_recharge_wallet';
            $wallet->wallet_type    = 1;
            $wallet->wallet_user_id = Auth()->user()->id;
            $wallet->wallet_transaction_id = $request->orderId;
            $wallet->wallet_description = "Add money Rs.".$request->orderAmount;
            $wallet->wallet_status = 1;
            $wallet->wallet_amount = $request->orderAmount;        
            $wallet->save();

            \Session::flash('success','Recharge success !');
        }else{
            \Session::flash('error','Recharge failure !');
        }

        return redirect()->route('wallets.index');
    }
}
