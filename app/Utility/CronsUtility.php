<?php
namespace App\Utility;
use App\Models\PoolMatrixCustomer;
use App\Models\User;
use App\Models\Wallets;
use App\Utility\PoolsUtility;
use App\Models\UserPoolslab;
use Illuminate\Support\Str;

class CronsUtility {

    public static function cron(){
        foreach (User::all() as $key => $value) {
            $users = PoolMatrixCustomer::where('pmc_parent_user_id',$value->id)->get();
            $total_counts =  count($users);
            foreach ($users as $key => $values) {
                $total_counts += CronsUtility::getCount($values);
            }
            
            //check slab is complete or not complete
            $user_slab = UserPoolslab::where('slab_user_id',$value->id)->where('slab_completed',0)->get();
            foreach ($user_slab as $keys => $slab) {
                if($total_counts >= $slab->slab_user_target){
                    $slab->slab_completed = 1;
                    $slab->save();
                    $amount = $slab->slab_amount;
                    //To do wallets commition
                    $wallet = new Wallets();
                    $wallet->wallet_uses    = 'pool_commition';
                    $wallet->wallet_type    = 1;// One means credit and Zero means Debit
                    $wallet->wallet_user_id = $value->id;
                    $wallet->wallet_transaction_id = Str::random(10);// after return payment gaytwaye
                    $wallet->wallet_description = "You have got Rs.".$amount." rupees pool commition !";
                    $wallet->wallet_status = 1;
                    $wallet->wallet_amount = $amount;
                    $wallet->save();
                }
            }
            unset($total_counts);
        }
        \Log::info("Successfully cron function working !");
    }
    //
    public static function getCount($users){
        $users = PoolMatrixCustomer::where('pmc_parent_user_id',$users->id)->get();
        $total_counts =  count($users);
        foreach ($users as $key => $values) {
            $total_counts += CronsUtility::getCount($values);
        }
        return $total_counts;
    }
}