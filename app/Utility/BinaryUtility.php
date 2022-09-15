<?php

namespace App\Utility;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Binary;
use App\Models\Pointvalue;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\Wallets;
use App\Models\RoyaltyTransaction;
use App\Models\CoreteamTransaction;
use App\Models\Rewardsvalue;
use App\Models\RewardsWallets;
use App\Models\Bonanzavalue;
use App\Models\BonanzaWallets;

class BinaryUtility {
    /*
    |This Methoad use for give commition level direct
    |@auther K.K ADIL KHAN AZAD
    */
    public static function binary_package_commission($user,$order){
        $orderItem = json_decode($order->orderItem->item_details);
        $binary = Binary::binary_users($user);
        $position = Binary::where('binary_user_id',$user->id)->first();
        //direct income ganrate
        BinaryUtility::direct_income($position,$order);
        //others
        BinaryUtility::core_team_income($order);
        BinaryUtility::royalty_income($order);
        //other income transactions
        foreach($binary as $key => $data){
            $user_side = $position->binary_user_side;
            if($key > 0){
               $user_side = $binary[$key-1]['user_side']; 
            }
            $activetion = Binary::where('binary_user_id',$data['user_id'])->where('binary_status','1')->count();
            //check user active then give commition and other value
            if($activetion > 0){

                $transaction_id = $order->order_transaction_id;
                $user_id = $data['user_id'];
                //point value 
                $pointvalue = new Pointvalue();
                $pointvalue->point_value = $orderItem->product_point_value;
                $pointvalue->point_value_side = $user_side;
                $pointvalue->point_value_rate = 5;
                $pointvalue->point_transaction_id = $transaction_id;
                $pointvalue->point_user_id = $user_id;
                $pointvalue->point_description= "By activating ".$user->name." binary plan, you have got ".number_formats($pointvalue->point_value)." point !";
                $pointvalue->point_type  = 1;
                if(Pointvalue::where('point_user_id',$user_id)
                    ->where('point_value_side',$user_side)
                    ->where('point_transaction_id',$transaction_id)
                    ->where('point_type',1)
                    ->count() <= 0){
                    $pointvalue->save();
                }
                BinaryUtility::binary_point_matching_comittion($pointvalue,$orderItem);

                //rewards value 
                $rewardsvalue = new Rewardsvalue();
                $rewardsvalue->rewards_value = $orderItem->product_rewards;
                $rewardsvalue->rewards_value_side = $user_side;
                $rewardsvalue->rewards_transaction_id = $transaction_id;
                $rewardsvalue->rewards_user_id = $user_id;
                $rewardsvalue->rewards_description= "By activating ".$user->name." binary plan, you have got ".number_formats($rewardsvalue->rewards_value)." rewards point !";
                $rewardsvalue->rewards_type  = 1;
                if(Rewardsvalue::where('rewards_user_id',$user_id)
                    ->where('rewards_value_side',$user_side)
                    ->where('rewards_transaction_id',$transaction_id)
                    ->where('rewards_type',1)
                    ->count() <= 0){
                    $rewardsvalue->save();
                }
                BinaryUtility::binary_reward_value_commission($rewardsvalue,$orderItem);

                //bonanza value point
                $bonanzaPoint = new Bonanzavalue();
                $bonanzaPoint->bonanza_value = $orderItem->product_bonanza_point;
                $bonanzaPoint->bonanza_value_side = $user_side;
                $bonanzaPoint->bonanza_transaction_id = $transaction_id;
                $bonanzaPoint->bonanza_user_id = $user_id;
                $bonanzaPoint->bonanza_description= "By activating ".$user->name." binary plan, you have got ".number_formats($bonanzaPoint->bonanza_value)." bonanza point !";
                $bonanzaPoint->bonanza_type  = 1;
                if(Bonanzavalue::where('bonanza_user_id',$user_id)
                    ->where('bonanza_value_side',$user_side)
                    ->where('bonanza_transaction_id',$transaction_id)
                    ->where('bonanza_type',1)
                    ->count() <= 0){
                    $bonanzaPoint->save();
                }
                BinaryUtility::binary_bonanza_matching_comittion($bonanzaPoint,$orderItem);
            }
        }
    }
    /*
    |This Methoad use for give bonanza point
    |@auther K.K ADIL KHAN AZAD
    */
    public static function binary_bonanza_matching_comittion($bonanza,$orderItem){
        $user_id = $bonanza->bonanza_user_id;
        $transaction_id = $bonanza->bonanza_transaction_id;
        if($bonanza->bonanza_value_side == 'R'){
            $match_point_side  = 'L';
            $totalPoint = Bonanzavalue::totalPointUserSide($user_id,$match_point_side);
        }else{
            $match_point_side = "R";
            $totalPoint = Bonanzavalue::totalPointUserSide($user_id,$match_point_side);
        }
        if($totalPoint > 0){
            //detect positive and nigative value
            $total_match_point = compare_values($totalPoint,$bonanza->bonanza_value);
            
            if($total_match_point > 0.1){

                $BonanzaWallets = new BonanzaWallets();
                $BonanzaWallets->wallet_uses    = 'binary_bonanza_commission';
                $BonanzaWallets->wallet_type    = 1;// One means credit and Zero means Debit
                $BonanzaWallets->wallet_user_id = $user_id;
                $BonanzaWallets->wallet_transaction_id = $transaction_id;
                $BonanzaWallets->wallet_status = 1;
                $BonanzaWallets->wallet_amount = $total_match_point;
                $BonanzaWallets->wallet_description = "Matching bonanza point you have got ".number_formats($BonanzaWallets->wallet_amount);
                if(BonanzaWallets::where('wallet_transaction_id',$transaction_id)
                    ->where('wallet_uses','binary_bonanza_commission')
                    ->where('wallet_user_id',$user_id)
                    ->count() <= 0){
                    $BonanzaWallets->save();
                }

                //right side point deduct
                $BonanzavalueR = new Bonanzavalue();
                $BonanzavalueR->bonanza_value = $total_match_point;
                $BonanzavalueR->bonanza_value_side = "R";
                $BonanzavalueR->bonanza_transaction_id = $transaction_id;
                $BonanzavalueR->bonanza_user_id = $user_id;
                $BonanzavalueR->bonanza_description= "Right Side Matching income bonanza point debited ".number_formats($total_match_point)." point !";
                $BonanzavalueR->bonanza_type  = 0;// One means credit and Zero means Debit
                if(Bonanzavalue::where('bonanza_user_id',$user_id)
                    ->where('bonanza_value_side','R')
                    ->where('bonanza_transaction_id',$transaction_id)
                    ->where('bonanza_type',0)
                    ->count() <= 0){
                    $BonanzavalueR->save();
                }

                //left side point deduct
                $BonanzavalueL = new Bonanzavalue();
                $BonanzavalueL->bonanza_value = $total_match_point;
                $BonanzavalueL->bonanza_value_side = "L";
                $BonanzavalueL->bonanza_transaction_id = $transaction_id;
                $BonanzavalueL->bonanza_user_id = $user_id;
                $BonanzavalueL->bonanza_description= "Left Side Matching income bonanza point debited ".number_formats($total_match_point)." point !";
                $BonanzavalueL->bonanza_type  = 0;// One means credit and Zero means Debit
                if(Bonanzavalue::where('bonanza_user_id',$user_id)
                    ->where('bonanza_value_side','L')
                    ->where('bonanza_transaction_id',$transaction_id)
                    ->where('bonanza_type',0)
                    ->count() <= 0){
                    $BonanzavalueL->save();
                }
            }
        }
    }
    /*
    |This Methoad use for give matching comittion
    |@auther K.K ADIL KHAN AZAD
    */
    public static function binary_point_matching_comittion($pointvalue,$orderItem){
        $user_id = $pointvalue->point_user_id;
        $transaction_id = $pointvalue->point_transaction_id;
        //$capping = $orderItem->product_capping;
        //for capping checking 
        $cappingorder = Order::where('user_id',$user_id)->with('orderItem')->orderBy('id','desc')->first();
        if(!empty($cappingorder->orderItem)){
            $capping = @$cappingorder->orderItem->product_capping;
        }else{
            $capping = 0;
        }
        

        if($pointvalue->point_value_side == 'R'){
            $match_point_side  = 'L';
            $totalPoint = Pointvalue::totalPointUserSide($user_id,$match_point_side);
        }else{
            $match_point_side = "R";
            $totalPoint = Pointvalue::totalPointUserSide($user_id,$match_point_side);
        }
        

        if($totalPoint > 0){
            //detect positive and nigative value
            $total_match_point = compare_values($totalPoint,$pointvalue->point_value);

            if($total_match_point > 0.1){
                $is_ganration = false;
                $amount = 0;
                //wallets capping condetion code here
                $today_total  = Wallets::where('wallet_uses','binary_matching_commission')->where('wallet_user_id',$user_id)->where('created_at', '>=', Carbon::now());
                //capping condetion here check if capping over then amount not transfer in wallets
                if($today_total->sum('wallet_amount') < $capping || $today_total->count() <= 0){
                    $wallet = new Wallets();
                    $wallet->wallet_uses    = 'binary_matching_commission';
                    $wallet->wallet_type    = 1;// One means credit and Zero means Debit
                    $wallet->wallet_user_id = $user_id;
                    $wallet->wallet_transaction_id = $transaction_id;
                    $wallet->wallet_status = 1;
                    $wallet->wallet_amount = ($total_match_point * 5);
                    $wallet->wallet_description = "Matching income point you have got ".number_formats($wallet->wallet_amount);
                    if(Wallets::where('wallet_transaction_id',$transaction_id)
                        ->where('wallet_uses','binary_matching_commission')
                        ->where('wallet_user_id',$user_id)
                        ->where('wallet_type',1)
                        ->count() <= 0){
                        $wallet->save();

                        $is_ganration = true;
                        $amount = $wallet->wallet_amount;
                    }
                }

                if($is_ganration){
                    //Generation Income
                    BinaryUtility::generation_income($wallet,$orderItem,$amount);
                }
                //right side point deduct
                $pointvalueR = new Pointvalue();
                $pointvalueR->point_value = $total_match_point;
                $pointvalueR->point_value_side = "R";
                $pointvalueR->point_value_rate = 5;
                $pointvalueR->point_transaction_id = $transaction_id;
                $pointvalueR->point_user_id = $user_id;
                $pointvalueR->point_description= "Right Side Matching income point debited ".number_formats($total_match_point)." point !";
                $pointvalueR->point_type  = 0;// One means credit and Zero means Debit
                if(Pointvalue::where('point_user_id',$user_id)
                    ->where('point_value_side','R')
                    ->where('point_transaction_id',$transaction_id)
                    ->where('point_type',0)
                    ->count() <= 0){
                    $pointvalueR->save();
                }
                //left side point deduct
                $pointvalueL = new Pointvalue();
                $pointvalueL->point_value = $total_match_point;
                $pointvalueL->point_value_side = "L";
                $pointvalueL->point_value_rate = 5;
                $pointvalueL->point_transaction_id = $transaction_id;
                $pointvalueL->point_user_id = $user_id;
                $pointvalueL->point_description= "Left Side Matching income point debited ".number_formats($total_match_point)." point !";
                $pointvalueL->point_type  = 0;// One means credit and Zero means Debit
                if(Pointvalue::where('point_user_id',$user_id)
                    ->where('point_value_side','L')
                    ->where('point_transaction_id',$transaction_id)
                    ->where('point_type',0)
                    ->count() <= 0){
                    $pointvalueL->save();
                }
            }
        }
    } 
     /*
    |This Methoad use for give matching rewards points
    |@auther K.K ADIL KHAN AZAD
    */
    public static function binary_reward_value_commission($rewardsvalue,$orderItem){
        $user_id = $rewardsvalue->rewards_user_id;
        $transaction_id = $rewardsvalue->transaction_id;

        if($rewardsvalue->rewards_value_side == 'R'){
            $match_point_side  = 'L';
            $totalPoint = Rewardsvalue::totalPointUserSide($user_id,$match_point_side);
        }else{
            $match_point_side = "R";
            $totalPoint = Rewardsvalue::totalPointUserSide($user_id,$match_point_side);
        }
        

        if($totalPoint > 0){
            //detect positive and nigative value
            $total_match_point = compare_values($totalPoint,$rewardsvalue->rewards_value);

            if($total_match_point > 0.1){  
            	$rewardsWallets = new RewardsWallets();
                $rewardsWallets->wallet_uses    = 'binary_rewards_commission';
                $rewardsWallets->wallet_type    = 1;// One means credit and Zero means Debit
                $rewardsWallets->wallet_user_id = $user_id;
                $rewardsWallets->wallet_transaction_id = $transaction_id;
                $rewardsWallets->wallet_status = 1;
                $rewardsWallets->wallet_amount = $total_match_point;
                $rewardsWallets->wallet_description = "Matching rewards point you have got ".number_formats($rewardsWallets->wallet_amount);
                if(RewardsWallets::where('wallet_transaction_id',$transaction_id)
                    ->where('wallet_uses','binary_rewards_commission')
                    ->where('wallet_user_id',$user_id)
                    ->count() <= 0){
                    $rewardsWallets->save();
                }
                

                //right side point deduct
                $rewardsvalueR = new Rewardsvalue();
                $rewardsvalueR->rewards_value = $total_match_point;
                $rewardsvalueR->rewards_value_side = "R";
                $rewardsvalueR->rewards_transaction_id = $transaction_id;
                $rewardsvalueR->rewards_user_id = $user_id;
                $rewardsvalueR->rewards_description= "Right Side Matching income point debited ".number_formats($total_match_point)." point !";
                $rewardsvalueR->rewards_type  = 0;// One means credit and Zero means Debit
                if(Rewardsvalue::where('rewards_user_id',$user_id)
                    ->where('rewards_value_side','R')
                    ->where('rewards_transaction_id',$transaction_id)
                    ->where('rewards_type',0)
                    ->count() <= 0){
                    $rewardsvalueR->save();
                }
                
                //left side point deduct
                $rewardsvalueL = new Rewardsvalue();
                $rewardsvalueL->rewards_value = $total_match_point;
                $rewardsvalueL->rewards_value_side = "L";
                $rewardsvalueL->rewards_transaction_id = $transaction_id;
                $rewardsvalueL->rewards_user_id = $user_id;
                $rewardsvalueL->rewards_description= "Left Side Matching income point debited ".number_formats($total_match_point)." point !";
                $rewardsvalueL->rewards_type  = 0;// One means credit and Zero means Debit
                if(Rewardsvalue::where('rewards_user_id',$user_id)
                    ->where('rewards_value_side','L')
                    ->where('rewards_transaction_id',$transaction_id)
                    ->where('rewards_type',0)
                    ->count() <= 0){
                    $rewardsvalueL->save();
                }
            }
        }
    } 
    /*
    |This Methoad use for give direct income
    |@auther K.K ADIL KHAN AZAD
    */
    public static function direct_income($binary_user,$order){
    	$orderItem = json_decode($order->orderItem->item_details);
        $order_transaction_id = $order->order_transaction_id;
    	$wallet = new Wallets();
        $wallet->wallet_uses    = 'binary_direct_commission';
        $wallet->wallet_type    = 1;// One means credit and Zero means Debit
        $wallet->wallet_user_id = $binary_user->binary_sponsor_id;
        $wallet->wallet_transaction_id = $order_transaction_id;
        $wallet->wallet_status = 1;
        $wallet->wallet_amount = $orderItem->product_direct_income;
        $wallet->wallet_description = "Direct income from binary plan you have got Rs.".number_formats($wallet->wallet_amount);
        
        if(Wallets::where('wallet_transaction_id',$order_transaction_id)
            ->where('wallet_uses','binary_direct_commission')
            ->where('wallet_type','1')
            ->where('wallet_user_id',$binary_user->binary_sponsor_id)->count() <= 0){
            $wallet->save();
        }
    }
    /*
    |This Methoad use for give royalty income
    |@auther K.K ADIL KHAN AZAD
    */
    public static function royalty_income($order){
    	$orderItem = json_decode($order->orderItem->item_details);
        $order_transaction_id = $order->order_transaction_id;

    	$royaltyTransaction = new RoyaltyTransaction();
    	$royaltyTransaction->transaction_transaction_id = $order_transaction_id;
    	$royaltyTransaction->transaction_amount = $orderItem->product_royalty;
    	$royaltyTransaction->transaction_status = '1';
    	$royaltyTransaction->transaction_mode   = 'unsettled';//unsettled or settled
    	$royaltyTransaction->save();
        if(RoyaltyTransaction::where('transaction_transaction_id',$order_transaction_id)->count() <= 0){
            $royaltyTransaction->save();
        }
    }
    /*
    |This Methoad use for give royalty income
    |@auther K.K ADIL KHAN AZAD
    */
    public static function core_team_income($order){
    	$orderItem = json_decode($order->orderItem->item_details);
        $order_transaction_id = $order->order_transaction_id;
        
    	$coreteamTransaction = new CoreteamTransaction();
    	$coreteamTransaction->transaction_transaction_id = $order_transaction_id;
    	$coreteamTransaction->transaction_amount = $orderItem->product_core_team;
    	$coreteamTransaction->transaction_status = '1';
    	$coreteamTransaction->transaction_mode   = 'unsettled';//unsettled or settled
        if(CoreteamTransaction::where('transaction_transaction_id',$order_transaction_id)->count() <= 0){
            $coreteamTransaction->save();
        }
    }
    /*
    |This Methoad use for give generation income
    |@auther K.K ADIL KHAN AZAD
    */
    public static function generation_income($ObjWallet,$orderItem,$amount){
        $order_transaction_id = $ObjWallet->wallet_transaction_id;
        $generation_income = $amount / 100 * $orderItem->product_generation_income;
        $binary_user = Binary::where('binary_user_id',$ObjWallet->wallet_user_id)->first();

        $wallet = new Wallets();
        $wallet->wallet_uses    = 'binary_generation_income';
        $wallet->wallet_type    = 1;// One means credit and Zero means Debit
        $wallet->wallet_user_id = $binary_user->binary_parent_id;
        $wallet->wallet_transaction_id = $order_transaction_id;
        $wallet->wallet_status = 1;
        $wallet->wallet_amount = $generation_income;
        $wallet->wallet_description = "Binary generation income you have got ".number_formats($wallet->wallet_amount);
        
        if(Wallets::where('wallet_transaction_id',$order_transaction_id)
            ->where('wallet_uses','binary_generation_income')
            ->where('wallet_type','1')
            ->where('wallet_user_id',$binary_user->binary_parent_id)->count() <= 0){
            $wallet->save();
        }
    }
}