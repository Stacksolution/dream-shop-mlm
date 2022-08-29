<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderItems(){
        return $this->hasMany(OrdersItem::class,'id','item_order_id');
    } 

    public function orderItem(){
        return $this->hasOne(OrdersItem::class,'item_order_id','id');
    } 
}
