<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrdersItem;
use App\Models\Product;
use Illuminate\Support\Str;  

class OrderController extends Controller
{
	
	public function store(Request $request){
		
	}	

	public function orderNow(Request $request){
		$product = Product::find($request->product_id);
		$order = new Order();
		$order->user_id = Auth()->user()->id;
		$order->order_total = $product->product_price;
		$order->order_total_tax = $product->product_price;
		$order->order_tax_details = json_encode([array('level'=>"GST",'value'=>$product->product_price)]);
		$order->order_grand_total = $product->product_price;
		$order->order_transaction_id = Str::random('10') ;
		$order->order_payment_status = 'unpaid';
		$order->order_payment_mode = 'online';
		if($order->save()){
			$orderItem = new OrdersItem();
			$orderItem->item_produt_id = $product->id;
			$orderItem->item_order_id  = $order->id;
			$orderItem->item_price = $product->product_price;
			$orderItem->item_tax = $order->order_total_tax;
			$orderItem->item_tax_details = $order->order_tax_details;
			$orderItem->item_details = json_encode($product);
			$orderItem->save();
			return redirect()->route('plan.payment',[$order->order_transaction_id,'binary']);
		}else{
			return back();
		}
	}
}