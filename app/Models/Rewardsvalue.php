<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rewardsvalue extends Model
{
    use HasFactory;

    public static function totalPointUserSide($user_id,$user_side){
        $balance =  Rewardsvalue::selectRaw('sum(case when rewards_type="1" then rewards_value else -rewards_value end) as balance')->where('rewards_user_id',$user_id)->where('rewards_value_side',$user_side)->first();
        return @$balance->balance;
    }
}
