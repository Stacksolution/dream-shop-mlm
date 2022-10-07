<?php
namespace App\Utility;
use App\Models\PoolMatrixCustomer;
use App\Models\User;
use App\Models\Wallets;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Utility\PoolsUtility;

class CommissionUtility {
    /*
    |This Methoad use for give commition
    |@auther K.K ADIL KHAN AZAD
    */
    public static function direct_level_income($user,$orderId){
        $users = User::direct_team_users($user);
        $amount = 0;
        foreach($users as $key => $data){
            $amount = 42; //second level
            //pool_direct_level_commition
            $wallet = new Wallets();
            $wallet->wallet_uses    = 'pool_direct_level_commition';
            $wallet->wallet_type    = 1;// One means credit and Zero means Debit
            $wallet->wallet_user_id = $data['user_id'];
            $wallet->wallet_transaction_id = $orderId;// after return payment gaytwaye
            $wallet->wallet_description = "By activating ".$user->name."'s profile, you have got Rs.".$amount." rupees !";
            $wallet->wallet_status = 1;
            $wallet->wallet_amount = $amount;
            $wallet->save();
        } 
    }
}