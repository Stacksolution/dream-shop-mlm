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
}