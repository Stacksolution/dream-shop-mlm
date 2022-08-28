<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoolMatrixCustomer extends Model
{   
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id','pmc_user_id','pmc_level_value','pmc_level_name','pmc_user_side'];

    public function user(){
        return $this->hasOne(User::class,'id');
    }

    public static function level_users($user){
        $user_recored = array();
        $records = PoolMatrixCustomer::where('pmc_user_id',$user->id)->with('user')->first();
        array_push($user_recored,array('user_id'=>$records->user->id,'user_name'=>$records->user->name,'user_referral'=>$records->user->user_referral,'parent_id'=>$records->pmc_parent_id));
        if(!empty($records)){
            for($i = 1; $i < 11 ; $i ++ ){
                if(!empty($records->user->user_referral_by)){
                    $parent_id = $user_recored[$i-1]['parent_id'];
                    // $records =  
                    $records = PoolMatrixCustomer::where('pmc_user_id',$parent_id)->with('user')->first();
                    array_push($user_recored,array('user_id'=>$records->user->id,'user_name'=>$records->user->name,'user_referral'=>$records->user->user_referral,'parent_id'=>$records->pmc_parent_id));
                }
            }
        }
        array_splice($user_recored, 0, 1);
        if(!empty($user_recored)){
           $user_recored = array_map("unserialize", array_unique(array_map("serialize", $user_recored))); 
        }
        return $user_recored;
    }

    public static function tree_users($user){
        $records = PoolMatrixCustomer::where('pmc_user_id',$user->id)->with('user')->get();
        foreach($records as $key => $data_1){
            if ($data_1 != null):
            $records[$key]->children = PoolMatrixCustomer::where('pmc_parent_id', $data_1->pmc_user_id)->get();
            foreach($records[$key]->children as $key_2 => $data_2){
                if ($data_2 != null):
                $records[$key]->children[$key_2]->children = PoolMatrixCustomer::where('pmc_parent_id', $data_2->pmc_user_id)->get();
                foreach($records[$key]->children[$key_2]->children as $key_3 => $data_3){
                    $records[$key]->children[$key_2]->children[$key_3]->children = PoolMatrixCustomer::where('pmc_parent_id', $data_3->pmc_user_id)->get();
                }
                endif;
            }
            endif;
        }
        return $records;
    }
}
