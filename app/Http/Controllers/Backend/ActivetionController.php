<?php

namespace App\Http\Controllers\Backend;

use Session;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\ActivationWallet;
use App\Models\PaymentLog;
use App\Models\User;
use App\Utility\CommissionUtility;
use App\Models\Wallets;

class ActivetionController extends Controller
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
     * Show the application back office dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        return view('back-end.customer.activation-page');
    }
    /**
     * Show the application view show
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(){
        
    }

    /**
     * This method use for manual offline for id activation 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manual_offline(Request $request)
    {   
        $user = User::findOrFail($request->id);
        return view('back-end.payment.offline.paymant-form');
    }
    /**
     * This method use for activetion update manualy 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {       
        $validated = $request->validate([
            'transaction_id' => 'required|min:8',
            'order_id' => 'required|min:8',
            'amount' => 'required|numeric',
        ]);
        
        $user = User::findOrFail($request->subscriprion);

        $activetion = new ActivationWallet();
        $activetion->active_amount  = $request->amount;
        $activetion->active_orderid = $request->order_id;
        $activetion->active_user_id = $user->id;//user id 
        if($activetion->save()){

            $payment = new PaymentLog();
            $payment->payment_amount  = $request->amount;
            $payment->payment_user_id = $user->id;
            $payment->payment_details = json_encode(['orderAmount'=>$request->amount,'orderId'=>$request->order_id,'paymentMode'=>'Manual','txTime'=>date('Y-m-d H:i:s')]);
            $payment->payment_status = '1';
            $payment->payment_type = '1';
            $payment->save();

            $user->user_id_status = 1;
            $user->save();

            if(Wallets::where('wallet_transaction_id',$request->order_id)->count() <= 0){
                //wallet or commition utility
                CommissionUtility::referral_commission($user,$request->order_id);
            }

            \Session::flash('success','Profile updated successfully !');
            return redirect()->route('customer.index');
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
    }
}