<?php
namespace App\Utility;
use App\Models\PoolMatrixCustomer;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Wallets;

class PoolsUtility {
    /*
    |This is a user define distributeion and implimented method Or Rule
    |==================================================================
    |@auther K.K ADIL KHAN AJAD 
    |@Method Pool system and MLM Distribution 
    |@Date 05-07-2022
    |==================================================================
    |       =====        =====    ===             =====        =====      
    |       =====        =====    ===             =====        =====
    |       === ==      == ===    ===             === ==      == ===
    |       ===  ==    ==  ===    ===             ===  ==    ==  ===
    |       ===   ==  ==   ===    ===             ===   ==  ==   ===
    |       ===    ====    ===    ===             ===    ====    === 
    |       ===     ==     ===    ===      ===    ===     ==     ===
    |       ===            ===    ============    ===            ===
    |       ===            ===    ============    ===            ===
    |==================================================================
    |USER = X is primary user Or main user like parents 
    |USER LEVEL = LX is secondry user Or leaf user like children Of X 
    |==================================================================
    */
    /*
    |pool_matrix_customers_create
    |This Methoad use for create pooluser create  
    |@auther K.K ADIL KHAN AZAD
    */
    public static function pool_matrix_customers_create($users) {
        $level = array('level_name' => 'LEVEL  01', 'level_value' => '1');
        for ($i = 1;$i <= 100;$i++) {
            array_push($level, array('level_name' => 'LEVEL  0' . $i, 'level_value' => $i));
        }
        //fetch level Or tree users
        $pool_users = PoolMatrixCustomer::orderBy('id', 'desc')->first();
        $parent_id = $users->id;

        if(!empty($pool_users)){
            $levels = $level[$pool_users->pmc_level_value - 1];
        }else{
            $levels = $level[0];
        }
        //fetch level wise user and count total users
        $current_level = $levels['level_value'];
        $count_level_user = PoolMatrixCustomer::where('pmc_level_value', $current_level)->count();
        $total_user_space = PoolsUtility::find_power_of_number(3, $current_level) - $count_level_user;

        if($total_user_space == 0){
            $level_data = PoolMatrixCustomer::where('pmc_level_value', $current_level)->first();
            //if leve is done then auto leve shift 
            $levels = $level[$pool_users->pmc_level_value];
        }
        //user tree complete and count user 
        if(!empty($pool_users)){
            $count_level_id = PoolMatrixCustomer::where('pmc_parent_id',$pool_users->pmc_parent_id)->count();
            if($count_level_id >= 3){
                $parent = PoolMatrixCustomer::where('pmc_parent_id',$pool_users->pmc_parent_id)->orderBy('id','asc')->limit(1)->first();
                $parent_user = PoolMatrixCustomer::find($parent->id);
                $parent_id = $parent_user->pmc_user_id;
            }else{
                $parent_id = $pool_users->pmc_parent_id;
            }
        }

        $poolcustomer = new PoolMatrixCustomer();
        $poolcustomer->pmc_user_id     = $users->id;
        $poolcustomer->pmc_level_value = $levels['level_value'];
        $poolcustomer->pmc_level_name  = $levels['level_name'];
        $poolcustomer->pmc_parent_id   = $parent_id;
        $poolcustomer->pmc_uniq_number = time();

        if(!empty($pool_users)){
            $poolcustomer->pmc_user_side = $pool_users->pmc_user_side == "L" ? 'R': 'L';
        }else{
           $poolcustomer->pmc_user_side = 'R';
        }
        $poolcustomer->save();
        
    }

    public static function find_power_of_number($num, $p) {
        if ($p == 0) return 1;
        return $num * PoolsUtility::find_power_of_number($num, $p - 1);
    }
    /*
    |pool_matrix_customers_create
    |This Methoad use for create pooluser create  
    |@auther K.K ADIL KHAN AZAD
    */
    public static function pool_direct_level_commition($user,$orderId){
        $users = User::direct_team_users($user);
        $amount = 0;
        $over_amoun =0; 
        foreach($users as $key => $data){
            if($key >= 1 && $key <= 2){
                $amount = 20; //first level
            }else{
                $amount = 10; //second level
            }

            if($data['user_id_status'] == 1 && $key >= 1){
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
            }else{
                $over_amoun+= $amount;
            }
        } 
        $wallet = new Wallets();
        $wallet->wallet_uses    = 'pool_direct_level_commition_over';
        $wallet->wallet_type    = 1;// One means credit and Zero means Debit
        $wallet->wallet_user_id = 1;
        $wallet->wallet_transaction_id = $orderId;// after return payment gaytwaye
        $wallet->wallet_description = "By activating ".$user->name."'s profile, you have got Rs.".$amount." rupees !";
        $wallet->wallet_status = 1;
        $wallet->wallet_amount = $over_amoun;
        $wallet->save();
    }
}