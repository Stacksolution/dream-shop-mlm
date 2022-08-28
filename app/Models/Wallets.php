<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'wallet_amount',
        'wallet_type',
        'wallet_user_id',
        'wallet_description',
        'wallet_transaction_id',
        'wallet_uses',
        'wallet_status',
        'wallet_tds_charge',
        'wallet_tds_rate',
        'wallet_service_carge',
        'wallet_service_rate'
    ];

    public static function balance($user_id){
       $balance =  Wallets::selectRaw('sum(case when wallet_type="1" then wallet_amount else -wallet_amount end) as balance')->where('wallet_user_id',$user_id)->first();
       return @$balance->balance;
    }

    public static function over_all_balance(){
       $balance =  Wallets::selectRaw('sum(case when wallet_type="1" then wallet_amount else -wallet_amount end) as balance')->first();
       return @$balance->balance;
    }

    public static function over_all_withdraw_balance(){
       $balance =  Wallets::selectRaw('sum(case when wallet_type="0" then wallet_amount end) as balance')->first();
       return @$balance->balance;
    }

    public static function overall($user_id){
       $balance =  Wallets::selectRaw('sum(case when wallet_type="1" then wallet_amount end) as balance')->where('wallet_user_id',$user_id)->first();
       return @$balance->balance;
    }

    public static function withdraw($user_id){
       $balance =  Wallets::selectRaw('sum(case when wallet_type="0" then wallet_amount end) as balance')->where('wallet_user_id',$user_id)->first();
       return @$balance->balance;
    }
}
