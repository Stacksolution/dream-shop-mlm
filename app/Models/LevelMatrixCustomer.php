<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelMatrixCustomer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['level_user_id','level_parent_id',''];


    public function user(){
        return $this->hasOne(User::class,'id');
    }

    public static function level_users($user){
        $user_recored = array();
        $records = LevelMatrixCustomer::where('level_user_id',$user->id)->with('user')->first();

        if(!empty($records)){
            array_push($user_recored,array('user_id'=>$records->user->id,'user_name'=>$records->user->name,'user_referral'=>$records->user->user_referral,'parent_id'=>$records->level_parent_id,'level_plan'=>true));

            if(!empty($records)){
                for($i = 0; $i < 10 ; $i ++ ){
                    $parent_id = @$user_recored[$i]['parent_id'];

                    $records = User::where('id',$parent_id)->first();
                    $parants = User::where('user_referral',$records->user_referral_by)->first();
                    $check = LevelMatrixCustomer::where('level_user_id',$records->id)->count();

                    if($check > 0){
                        array_push($user_recored,array('user_id'=>$records->id,'user_name'=>$records->name,'user_referral'=>$records->user_referral,'parent_id'=>$parants->id,'level_plan'=>true));
                    }else{
                        array_push($user_recored,array('user_id'=>$records->id,'user_name'=>$records->name,'user_referral'=>$records->user_referral,'parent_id'=>$parants->id,'level_plan'=>false));
                    }
                }
            }
            
            array_splice($user_recored, 0, 1);
            if(!empty($user_recored)){
               $user_recored = array_map("unserialize", array_unique(array_map("serialize", $user_recored))); 
            }
        }
        
        return $user_recored;
    }
}
