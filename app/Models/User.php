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

    public static function user_tree_level($user_id){
        $user_recored = array();
        $records = User::where('id',$user_id)->with('referrer')->get();

        foreach($records as $key => $data){
            $records[$key]->level_active = false;
            if(!empty($data->user_referral_by)){
                //level -1
                $level1_referrals = array();
                $records_1 = User::where('user_referral_by',$data->user_referral)->get();
                foreach($records_1 as $keys => $data_1){
                    if($data_1->user_referral != $data->user_referral){
                        array_push($level1_referrals,$data_1->user_referral);
                    }
                }
                array_push($user_recored,['levels'=>'Levels 01','users'=>$records_1]);
                
                //level -2
                if(!empty($level1_referrals)){
                    $level2_referrals = array();
                    $records_2 = User::whereIn('user_referral_by',$level1_referrals)->with('referrer')->get();
                    foreach($records_2 as $keys => $data_1){
                        if(!in_array($data_1->user_referral,$level1_referrals)){
                            array_push($level2_referrals,$data_1->user_referral);
                        }
                    }
                    array_push($user_recored,['levels'=>'Levels 02','users'=>$records_2]);
                }

                //level -3
                if(!empty($level2_referrals)){
                    $level3_referrals = array();
                    $records_3 = User::whereIn('user_referral_by',$level2_referrals)->with('referrer')->get();
                    foreach($records_3 as $keys => $data_1){
                        if(!in_array($data_1->user_referral,$level2_referrals)){
                            array_push($level3_referrals,$data_1->user_referral);
                        }
                    }
                    array_push($user_recored,['levels'=>'Levels 03','users'=>$records_3]);
                }

                //level -4
                if(!empty($level3_referrals)){
                    $level4_referrals = array();
                    $records_4 = User::whereIn('user_referral_by',$level3_referrals)->with('referrer')->get();
                    foreach($records_4 as $keys => $data_1){
                        if(!in_array($data_1->user_referral,$level3_referrals)){
                            array_push($level4_referrals,$data_1->user_referral);
                        }
                    }
                    array_push($user_recored,['levels'=>'Levels 04','users'=>$records_4]);
                }


                //level -5
                if(!empty($level4_referrals)){
                    $level5_referrals = array();
                    $records_5 = User::whereIn('user_referral_by',$level4_referrals)->with('referrer')->get();
                    foreach($records_5 as $keys => $data_1){
                        if(!in_array($data_1->user_referral,$level4_referrals)){
                            array_push($level5_referrals,$data_1->user_referral);
                        }
                    }
                    array_push($user_recored,['levels'=>'Levels 05','users'=>$records_5]);
                }
            }
            $records[$key]->level = $user_recored;
        }
        return $records;
    }
}
