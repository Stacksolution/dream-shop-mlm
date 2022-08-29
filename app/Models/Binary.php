<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binary extends Model
{   
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id','binary_user_id','binary_referral','binary_referral_by','binary_parent_id','binary_user_side','binary_status','binary_sponsor_id'];

    public function user(){
        return $this->hasOne(User::class,'id','binary_user_id');
    }

    public static function level_users($user){
        $user_recored = array();
        $records = Binary::where('binary_user_id',$user->id)->with('user')->get();
        foreach($records as $key => $data_1){
            if ($data_1->user != null):
            $records[$key]->children = Binary::where('binary_parent_id',$data_1->user->id)->with('user')->get();
            foreach($records[$key]->children as $key_2 => $data_2){
                if ($data_2->user != null):
                $records[$key]->children[$key_2]->children = Binary::where('binary_parent_id',$data_2->user->id)->with('user')->get();
                foreach($records[$key]->children[$key_2]->children as $key_3 => $data_3){
                    if ($data_3->user != null):
                        $records[$key]->children[$key_2]->children[$key_3]->children = Binary::where('binary_parent_id',$data_3->user->id)->with('user')->get();
                        foreach($records[$key]->children[$key_2]->children[$key_3]->children as $key_4 => $data_4){
                            if ($data_2->user != null):
                                $records[$key]->children[$key_2]->children[$key_3]->children[$key_4]->children = Binary::where('binary_parent_id',$data_4->user->id)->with('user')->get();
                            endif;
                        }

                    endif;
                }
                endif;
            }
            endif;
        }
        return $records;
    }

    public static function binary_users($user){
        $user_recored = array();
        $records = Binary::where('binary_user_id',$user->id)->with('user')->first();

        if(!empty($records)){

            if($records->binary_status = 1){
                array_push($user_recored,array('user_id'=>$records->user->id,'user_name'=>$records->user->name,'user_referral'=>$records->user->user_referral,'parent_id'=>$records->binary_parent_id,'status'=>true,'user_side'=>$records->binary_user_side));
            }else{
                array_push($user_recored,array('user_id'=>$records->user->id,'user_name'=>$records->user->name,'user_referral'=>$records->user->user_referral,'parent_id'=>$records->binary_parent_id,'status'=>false,'user_side'=>$records->binary_user_side));
            }
            

            if(!empty($records)){
                for($i = 0; $i < 10 ; $i ++ ){
                    $parent_id = @$user_recored[$i]['parent_id'];
                    $records = Binary::where('binary_user_id',$parent_id)->with('user')->first();
                    if(!empty($records->user)){
                        if($records->binary_status = 1){
                            array_push($user_recored,array('user_id'=>$records->user->id,'user_name'=>$records->user->name,'user_referral'=>$records->user->user_referral,'parent_id'=>$records->binary_parent_id,'status'=>true,'user_side'=>$records->binary_user_side));
                        }else{
                            array_push($user_recored,array('user_id'=>$records->user->id,'user_name'=>$records->user->name,'user_referral'=>$records->user->user_referral,'parent_id'=>$records->binary_parent_id,'status'=>false,'user_side'=>$records->binary_user_side));
                        }
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
