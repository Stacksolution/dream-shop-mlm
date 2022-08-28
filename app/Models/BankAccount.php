<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bank_name',
        'bank_account_number',
        'bank_account_holder',
        'bank_ifsc',
        'bank_beneficiary',
        'bank_mobile_number',
        'bank_address',
        'bank_is_default',
        'bank_user_id',
        'bank_status'
    ];
}
