<?php

namespace App\Http\Controllers\Backend;

use Session;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utility\ActivetionUtility;
use App\Utility\CommissionUtility;
use App\Models\User;
use App\Models\Wallets;
use App\Models\PaymentLog;
use App\Models\PoolMatrixCustomer;
use App\Mail\SignupEmail;
use Mail;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application back office dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {    
        
        if(Auth()->user()->user_type == 'customer'){
            return redirect()->route('client.dashboard');
        }
        
        $countmember = User::count();
        $wallets = Wallets::over_all_balance();
        $payment = PaymentLog::sum('payment_amount');
        $withdraw = Wallets::over_all_withdraw_balance();
        $tds = Wallets::sum('wallet_tds_charge');
        $service = Wallets::sum('wallet_service_charge');
        return view('back-end.dashboard.index',compact('countmember','wallets','payment','withdraw','service','tds'));
    }
    /**
     * Clear the application cache back office.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function clearCache(Request $request){
        Artisan::call('cache:clear');
        Artisan::call('route:cache');
        session()->flash('success', 'Cache cleared successfully !');
        return back();
    }

    /**
     * Show the application back office clint dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clintdashboard(Request $request)
    {    
        
        $countmember = User::where('user_referral_by',Auth()->User()->user_referral)->count();
        $wallets = Wallets::balance(Auth()->User()->id);
        return view('back-end.customer.dashboard',compact('countmember','wallets'));
    }

    /**
     * This method use for welcome page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome(Request $request)
    {  
        return view('back-end.customer.welcome');
    }
}
