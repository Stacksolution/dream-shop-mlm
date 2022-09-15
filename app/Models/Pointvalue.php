<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointvalue extends Model
{
    use HasFactory;

    public static function totalPointUserSide($user_id,$user_side){
        $balance =  Pointvalue::selectRaw('sum(case when point_type="1" then point_value else -point_value end) as balance')->where('point_user_id',$user_id)->where('point_value_side',$user_side)->first();
       return @$balance->balance;
    }
}
