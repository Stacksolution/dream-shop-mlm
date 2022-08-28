<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'document_id_number',
        'document_front_image',
        'document_back_image',
        'document_user_id',
        'document_status'
    ];


    public static function document_status($user_id){
        $status = 'approved';
        $document = Document::where('document_user_id',$user_id)->get();

        if(count($document) <= 0 ){
            $status = "not uploaded";
        }

        foreach ($document as $key => $value) {
            if($value->document_status == 0 || $value->document_status == 2){
                $status = 'pending';
                break;
            }
        }
        return $status;
    }
}
