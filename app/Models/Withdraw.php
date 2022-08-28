<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'withdraw_amount',
        'withdraw_bank_id',
        'withdraw_bank',
        'withdraw_user_id',
        'withdraw_transaction_id',
        'withdraw_status',
        'withdraw_tds_charge',
        'withdraw_tds_rate',
        'withdraw_service_carge',
        'withdraw_service_rate'
    ];
}
