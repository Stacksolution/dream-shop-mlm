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
use App\Models\Coins;
use App\Models\PaymentLog;
use App\Models\PoolMatrixCustomer;
use App\Models\LevelMatrixCustomer;
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
        //PoolMatrixCustomer::level_users(User::find(145));

        if(Auth()->user()->user_type == 'customer'){
            return redirect()->route('client.dashboard');
        }
        
        $countmember = User::count();
        $wallets = Wallets::over_all_balance();
        $coins = Coins::over_all_balance();
        $payment = PaymentLog::sum('payment_amount');
        $withdraw = Wallets::over_all_withdraw_balance();
        $tds = Wallets::sum('wallet_tds_charge');
        $service = Wallets::sum('wallet_service_charge');
        return view('back-end.dashboard.index',compact('countmember','wallets','payment','coins','withdraw','service','tds'));
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
        $level = LevelMatrixCustomer::where('level_user_id',Auth()->user()->id)->count() > 0 ? 1 : 0 ; 
        $activation = array(
            'level_1'=>Auth()->user()->user_id_status,
            'level_2'=>$level,
            'level_3'=>0,
            'level_4'=>0,
            'level_5'=>0
        );

        CommissionUtility::login_commission(Auth()->User());
        $countmember = User::where('user_referral_by',Auth()->User()->user_referral)->count();
        $wallets = Wallets::balance(Auth()->User()->id);
        $coins = Coins::balance(Auth()->User()->id);
        return view('back-end.customer.dashboard',compact('countmember','wallets','coins','activation'));
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
