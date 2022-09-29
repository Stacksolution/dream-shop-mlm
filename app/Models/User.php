<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'user_referral',
        'user_referral_by',
        'user_image',
        'user_mobile',
        'user_id_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function paymentlog(){
        return $this->hasOne(PaymentLog::class,'id');
    }

    public function doscuments(){
        return $this->hasMany(Document::class,'id','document_user_id');
    }

    public function LevelMatrixCustomer(){
        return $this->hasOne(LevelMatrixCustomer::class,'id');
    }

    public function referrer(){
        return $this->hasOne(User::class,'user_referral','user_referral_by');
    }
    
    public static function direct_team_users($user){
        $user_recored = array();
        $records = User::where('id',$user->id)->with('referrer')->first();
        array_push($user_recored,array('user_id'=>$records->id,'user_name'=>$records->name,'user_referral'=>$records->user_referral,'parent_id'=>$records->referrer->id,'user_id_status'=>$records->referrer->user_id_status));
        if(!empty($records)){
            for($i = 1; $i < 6 ; $i ++ ){
                if(!empty($records->referrer->id)){
                    $parent_id = $user_recored[$i-1]['parent_id'];
                    // $records =  
                    $records = User::where('id',$parent_id)->with('referrer')->first();
                    array_push($user_recored,array('user_id'=>$records->id,'user_name'=>$records->name,'user_referral'=>$records->user_referral,'parent_id'=>$records->referrer->id,'user_id_status'=>$records->referrer->user_id_status));
                }
            }
        }
        array_splice($user_recored, 0, 1);
        if(!empty($user_recored)){
           $user_recored = array_map("unserialize", array_unique(array_map("serialize", $user_recored))); 
        }
        return $user_recored;
    }
}
