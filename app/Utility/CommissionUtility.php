<?php
namespace App\Utility;
use App\Models\PoolMatrixCustomer;
use App\Models\LevelMatrixCustomer;
use App\Models\User;
use App\Models\Wallets;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Coins;
use App\Models\Binary;
use App\Models\Pointvalue;
use App\Models\Order;
use App\Utility\PoolsUtility;

class CommissionUtility {
    /*
    |This Methoad use for give commition
    |@auther K.K ADIL KHAN AZAD
    */
    public static function referral_commission($user,$orderId) {
        PoolsUtility::pool_direct_level_commition($user,$orderId);
        //referral_commission
        $referred_user = User::where('user_referral',$user->user_referral_by)->first();
        $wallet = new Wallets();
        $wallet->wallet_uses    = 'referral_commission';
        $wallet->wallet_type    = 1;// One means credit and Zero means Debit
        $wallet->wallet_user_id = $referred_user->id;
        $wallet->wallet_transaction_id = $orderId;// after return payment gaytwaye
        $wallet->wallet_description = "By activating ".$user->name."'s profile, you have got Rs.100 rupees !";
        $wallet->wallet_status = 1;
        $wallet->wallet_amount = 100;
        $wallet->save();
    }
    
    /*
    |This Methoad use for give commition
    |@auther K.K ADIL KHAN AZAD
    */
    public static function pool_level_commission($user,$orderId) {
        //level_income
        $referred_user = PoolMatrixCustomer::level_users($user);
        foreach($referred_user as $key => $data){
            $wallet = new Wallets();
            $wallet->wallet_uses    = 'level_income';
            $wallet->wallet_type    = 1;// One means credit and Zero means Debit
            $wallet->wallet_transaction_id = $orderId;// after return payment gaytwaye
            $wallet->wallet_user_id = $data['user_id'];
                $wallet->wallet_description = "You have received Rs.10 rupees pool level commition !";
            $wallet->wallet_status = 1;
            $wallet->wallet_amount = 10;
            $wallet->save();
        }
        
        if(count($referred_user)){
            $total  = (10-count($referred_user)) * 10;
            $wallet = new Wallets();
            $wallet->wallet_uses    = 'level_income_over';
            $wallet->wallet_type    = 1;// One means credit and Zero means Debit
            $wallet->wallet_transaction_id = $orderId;// after return payment gaytwaye
            $wallet->wallet_user_id = 1;
                $wallet->wallet_description = "You have received Rs.".$total." rupees pool level commition !";
            $wallet->wallet_status = 1;
            $wallet->wallet_amount = $total;
            $wallet->save();
        }
    }
    /*
    |This Methoad use for give login commition
    |@auther K.K ADIL KHAN AZAD
    */
    /*
    |This Methoad use for give login commition
    |@auther K.K ADIL KHAN AZAD
    */
    public static function login_commission($user){
        $total_login = 0;
        if('2022-08-03 11:00' > $user->created_at){
            //100 time given login commission
            $login_attepmt = Wallets::where('wallet_user_id',$user->id)->where('wallet_uses','login_commission')->count();
            $total_login = $login_attepmt;
        }else{
            //20 time given login commission
            $login_attepmt = Wallets::where('wallet_user_id',$user->id)->where('wallet_uses','login_commission')->count();
            $total_login = $login_attepmt + 80;
        }

        //login_commission
        $todaywallets = Wallets::whereDate('created_at',Carbon::today())->where('wallet_user_id',$user->id)->where('wallet_uses','login_commission')->count();
        if($todaywallets <= 0 && $total_login <= 100){
            $wallet = new Wallets();
            $wallet->wallet_uses    = 'login_commission';
            $wallet->wallet_type    = 1;// One means credit and Zero means Debit
            $wallet->wallet_user_id = $user->id;
            $wallet->wallet_transaction_id = time();
            $wallet->wallet_description = "You have get Rs.5 rupees for login ".env('APP_NAME')." !";
            $wallet->wallet_status = 1;
            $wallet->wallet_amount = 5;
            $wallet->save();
        }
    }
    /*
    |This Methoad use for give coins
    |@auther K.K ADIL KHAN AZAD
    */
    public static function signup_coins($user,$orderId){
        //signup_coins
        $coin = new Coins();
        $coin->coin_uses    = 'signup_coins';
        $coin->coin_type    = 1;// One means credit and Zero means Debit
        $coin->coin_user_id = $user->id;
        $coin->coin_transaction_id = $orderId;
        $coin->coin_description = "You have get 200 Coins for signup ".env('APP_NAME')." !";
        $coin->coin_status = 1;
        $coin->coin_amount = 200;
        $coin->save();    
    }
    
    /*
    |This Methoad use for binary commission
    |@auther K.K ADIL KHAN AZAD
    */
    public static function binary_commission($user){
        //binary_commission
        $wallet = new Wallets();
        $wallet->wallet_uses    = 'binary_commission';
        $wallet->wallet_type    = 1;// One means credit and Zero means Debit
        $wallet->wallet_user_id = $user->id;
        $wallet->wallet_transaction_id = time();
        $wallet->wallet_description = "You have get Rs.20 rupees for binary ".env('APP_NAME')." !";
        $wallet->wallet_status = 1;
        $wallet->wallet_amount = 20;
        $wallet->save();
    }


    /*
    |This Methoad use for give commition
    |@auther K.K ADIL KHAN AZAD
    */
    public static function level_income_commission($user) {
        $total_serve_amounts = 0;
        $i = 1;
        //level_income
        $referred_user = LevelMatrixCustomer::level_users($user);
        foreach($referred_user as $key => $data){
            if($data['level_plan'] == true){

                $wallet = new Wallets();
                $wallet->wallet_uses    = 'level_income_plan';
                $wallet->wallet_type    = 1;// One means credit and Zero means Debit
                $wallet->wallet_transaction_id = time();
                $wallet->wallet_user_id = $data['user_id'];
                $wallet->wallet_description = "You have received by Rs.10 rupees level plan income commition !";
                $wallet->wallet_status = 1;
                $wallet->wallet_amount = 10;
                $wallet->save();

                //total_serve_amounts 
                $total_serve_amounts +=10;
                $business_amount = $i;

                if($i > 1){
                    $business_amount = $business_amount -1;
                    $wallets = new Wallets();
                    $wallets->wallet_uses    = 'bussines_income';
                    $wallets->wallet_type    = 1;// One means credit and Zero means Debit
                    $wallets->wallet_transaction_id = time();
                    $wallets->wallet_user_id = $data['user_id'];
                    $wallets->wallet_description = "You have received Rs.".$business_amount." rupees generation income commition !";
                    $wallets->wallet_status = 1;
                    $wallets->wallet_amount = $business_amount-1;
                    $wallets->save();
                    //total_serve_amounts
                    $total_serve_amounts += $business_amount-1;
                } 
                $i++;  
            }
        }
        
        $total  = 150-$total_serve_amounts;
        $wallet = new Wallets();
        $wallet->wallet_uses    = 'level_income_plan_over';
        $wallet->wallet_type    = 1;// One means credit and Zero means Debit
        $wallet->wallet_transaction_id = time();
        $wallet->wallet_user_id = 1;
            $wallet->wallet_description = "You have received Rs.".$total." rupees level plan income commition !";
        $wallet->wallet_status = 1;
        $wallet->wallet_amount = $total;
        $wallet->save();
    }
    /*
    |This Methoad use for give commition level direct
    |@auther K.K ADIL KHAN AZAD
    */
    public static function level_direct_commission($user) {
        //level_direct_commission
        $referred_user = User::where('user_referral',$user->user_referral_by)->first();
        $wallet = new Wallets();
        $wallet->wallet_uses    = 'level_direct_commission';
        $wallet->wallet_type    = 1;// One means credit and Zero means Debit
        $wallet->wallet_user_id = $referred_user->id;
        $wallet->wallet_transaction_id = time();
        $wallet->wallet_description = "By activating ".$user->name."'s profile, you have got Rs.50 rupees !";
        $wallet->wallet_status = 1;
        $wallet->wallet_amount = 50;
        $wallet->save();
    }
}