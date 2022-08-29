<?php

namespace App\Http\Controllers\Backend;

use Artisan;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\OrderController;
use Illuminate\Http\Request; 
use Illuminate\Support\Str;   
use App\Models\PaymentLog;
use App\Models\LevelMatrixCustomer;
use App\Models\User;
use App\Models\ActivationWallet;
use App\Utility\CommissionUtility;
use App\Models\Order;
use App\Models\Wallets;

class CashfreeController extends Controller{
    //
    public function online_pay(Request $request){
        
        $orderAmount = 200;
        if($request->plan == 'binary'){
            $order = Order::where('order_transaction_id',$request->id)->first();
            $orderAmount = $order->order_total;
        }

        $payment = array( 
          "appId" => env('APP_ID'), 
          "orderId" => Str::random(10), 
          "orderAmount" => $orderAmount, 
          "orderCurrency" => "INR", 
          "orderNote" => "", 
          "customerName" => Auth()->user()->name, 
          "customerPhone" => Auth()->user()->user_mobile, 
          "customerEmail" => Auth()->user()->email,
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
            CashfreeController::level_payment($request);
        }else if($request->plan == 'pool'){
            //active and serving commition pool income 
            CashfreeController::pool_payment($request);
        }else if($request->plan == 'binary'){
            CashfreeController::binary_payment($request);
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
                CommissionUtility::referral_commission($user,$request->orderId);
                CommissionUtility::pool_level_commission($user,$request->orderId);
                CommissionUtility::signup_coins($user,$request->orderId);

                $active = new ActivationWallet();
                $active->active_amount  = $request->orderAmount;
                $active->active_orderid = $request->orderId;
                $active->active_user_id = $request->user_id;
                $active->save();
            }
        } 
    }
    /**
     * This method use for active level income user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function level_payment(Request $request){
        $user = User::findOrFail($request->user_id);
        $parent = User::where('user_referral',$user->user_referral_by)->first();

        if($request->txStatus == 'SUCCESS'){
            $payment = new PaymentLog();
            $payment->payment_amount  = $request->orderAmount;
            $payment->payment_user_id = $request->user_id;
            $payment->payment_details = json_encode($request->all());
            $payment->payment_status = '1';
            $payment->payment_type = '1';
            $payment->payment_uses = 'level_active_online';
            $payment->save();

            $level = new LevelMatrixCustomer();
            $level->level_user_id = $user->id;
            $level->level_parent_id = $parent->id;
            $level->level_uniq_number = time();
            $level->save();

            CommissionUtility::level_income_commission($user);
            CommissionUtility::level_direct_commission($user);
        }
    }
    /**
     * This method use for active binary plan
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function binary_payment(Request $request){
        if($request->txStatus == 'SUCCESS'){
            //$request->user_id  as order id 
            $order = Order::where('order_transaction_id',$request->user_id)->with('orderItem')->first();
            $order->order_payment_status = 'paid';
            $order->order_invoice_number = 'AA-'.sprintf('%08d',$order->id);
            $order->save();

            $payment = new PaymentLog();
            $payment->payment_amount  = $request->orderAmount;
            $payment->payment_user_id = $order->user_id;
            $payment->payment_details = json_encode($request->all());
            $payment->payment_status = '1';
            $payment->payment_type = '1';
            $payment->payment_uses = 'binary_active_online';
            $payment->save();

            CommissionUtility::binary_point_value_commission(Auth()->user(),$order);
        }
    }
}
