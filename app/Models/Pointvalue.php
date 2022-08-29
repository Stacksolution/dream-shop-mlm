<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointvalue extends Model
{
    use HasFactory;

    public static function totalPointUserSide($user_id,$user_side){
        return Pointvalue::where('point_user_id',$user_id)->where('point_value_side',$user_side)->sum('point_value');
    }
}
