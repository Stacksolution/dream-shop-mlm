<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coins extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'coin_amount',
        'coin_type',
        'coin_user_id',
        'coin_description',
        'coin_transaction_id',
        'coin_uses',
        'coin_status'
    ];

    public static function balance($user_id){
       $balance =  Coins::selectRaw('sum(case when coin_type="1" then coin_amount else -coin_amount end) as balance')->where('coin_user_id',$user_id)->first();
       return @$balance->balance > 0 ? $balance->balance : 0;
    }

    public static function over_all_balance(){
       $balance =  Coins::selectRaw('sum(case when coin_type="1" then coin_amount else -coin_amount end) as balance')->first();
       return @$balance->balance;
    }
}
