<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonanzavalue extends Model
{
    use HasFactory;

    public static function totalPointUserSide($user_id,$user_side){
        $balance =  Bonanzavalue::selectRaw('sum(case when bonanza_type="1" then bonanza_value else -bonanza_value end) as balance')->where('bonanza_user_id',$user_id)->where('bonanza_value_side',$user_side)->first();
       return @$balance->balance;
    }
}
