<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrdersItem;
use App\Models\Product;
use App\Models\Wallets;
use Illuminate\Support\Str;  

class OrderController extends Controller
{
	public function index(Request $request){

		$order = Order::query()->with('orderItem');
		if (Auth()->user()->user_type != 'admin') {
            $order->where('user_id',Auth()->user()->id);
        }
        $order->orderBy('id','desc');
        $orders = $order->paginate(10);
		return view('back-end.orders.index',compact('orders'));
	}

	public function store(Request $request){
		
	}	

	public function orderNow(Request $request){
		$product = Product::find($request->product_id);

		//check balance
		if($request->payment_mode == "wallets"){
        $balance = Wallets::balance($request->id);
        $balance += 500;
        if($balance < $product->product_price){
          \Session::flash('error','Insufficient wallet balance !');  
          return back();
        }
    }

		$order = new Order();
		$order->user_id = Auth()->user()->id;
		$total_gst = $product->product_price -($product->product_price * (100/(100+$product->product_tax_rate)));

		$order->order_total = $product->product_price;
		$order->order_total_tax = $total_gst;
		$order->order_tax_details = json_encode([array('level'=>"GST (".$product->product_tax_rate.")",'value'=>$total_gst)]);
		$order->order_grand_total = $product->product_price;
		$order->order_transaction_id = Str::random('10') ;
		$order->order_payment_status = 'unpaid';
		$order->order_payment_mode = $request->payment_mode;
		if($order->save()){
			$orderItem = new OrdersItem();
			$orderItem->item_produt_id = $product->id;
			$orderItem->item_order_id  = $order->id;
			$orderItem->item_price = $product->product_price;
			$orderItem->item_tax = $order->order_total_tax;
			$orderItem->item_tax_details = $order->order_tax_details;
			$orderItem->item_details = json_encode($product);
			$orderItem->save();
			if($request->payment_mode == "online"){
				return redirect()->route('plan.payment',[$order->order_transaction_id,'binary']);
			}else if($request->payment_mode == "wallets"){
				return redirect()->route('wallets.plan.payment',[$order->order_transaction_id,'binary']);
			}
		}else{
			\Session::flash('error','Oops something went wrong !');
			return back();
		}
	}
}