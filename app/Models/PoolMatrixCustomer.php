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
    
    public static function tree_users($user){
        $records = PoolMatrixCustomer::where('pmc_user_id',$user->id)->with('user')->get();
        foreach($records as $key => $data_1){
            if ($data_1 != null):
            $records[$key]->children = PoolMatrixCustomer::where('pmc_parent_id', $data_1->id)->get();
            foreach($records[$key]->children as $key_2 => $data_2){
                if ($data_2 != null):
                $records[$key]->children[$key_2]->children = PoolMatrixCustomer::where('pmc_parent_id', $data_2->id)->get();
                foreach($records[$key]->children[$key_2]->children as $key_3 => $data_3){
                    $records[$key]->children[$key_2]->children[$key_3]->children = PoolMatrixCustomer::where('pmc_parent_id', $data_3->id)->get();
                }
                endif;
            }
            endif;
        }
        return $records;
    }

    public function children(){
        //$this->hasMany(self::clas, 'foreign_key', 'local_key');
        return $this->hasMany(self::class, 'pmc_parent_id','id');
    }

    public function grandchildren(){
        return $this->children()->with('grandchildren');
    }
}
