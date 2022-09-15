<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardsWallets extends Model
{
    use HasFactory;

    public static function balance($user_id){
       $balance =  RewardsWallets::selectRaw('sum(case when wallet_type="1" then wallet_amount else -wallet_amount end) as balance')->where('wallet_user_id',$user_id)->first();
       return @$balance->balance;
    }

}
