<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $product = Product::query();
        $products = $product->paginate(10); 
        if(Auth()->user()->user_type == 'admin'){
            return view('back-end.products.index',compact('products'));
        }else{
            return view('back-end.products.products',compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|min:2',
            'hsn' => 'required',
            'amount' => 'required',
            'capping' => 'required',
            'direct_income' => 'required',
            'generation_income' => 'required',
            'point_value' => 'required',
            'rewards_point' => 'required',
            'royalty_income' => 'required',
            'core_team_income' => 'required',
            'bonanza_point' => 'required',
        ]);
        $product = new Product();
        $product->product_name  = $request->name;
        $product->product_hsn  = $request->hsn;
        $product->product_price  = $request->amount;
        $product->product_capping  = $request->capping;
        $product->product_direct_income  = $request->direct_income;
        $product->product_generation_income  = $request->generation_income;
        $product->product_point_value  = $request->point_value;
        $product->product_rewards  = $request->rewards_point;
        $product->product_royalty  = $request->royalty_income;
        $product->product_core_team  = $request->core_team_income;
        $product->product_bonanza_point  = $request->bonanza_point;

        if($product->save()){
            \Session::flash('success','Product successfully created!');
            return redirect()->route('product.index');
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
       return view('back-end.products.view',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {   
        return view('back-end.products.update',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|min:2',
            'hsn' => 'required',
            'amount' => 'required',
            'capping' => 'required',
            'direct_income' => 'required',
            'generation_income' => 'required',
            'point_value' => 'required',
            'rewards_point' => 'required',
            'royalty_income' => 'required',
            'core_team_income' => 'required',
            'bonanza_point' => 'required',
        ]);
        $product->product_name  = $request->name;
        $product->product_hsn  = $request->hsn;
        $product->product_price  = $request->amount;
        $product->product_capping  = $request->capping;
        $product->product_direct_income  = $request->direct_income;
        $product->product_generation_income  = $request->generation_income;
        $product->product_point_value  = $request->point_value;
        $product->product_rewards  = $request->rewards_point;
        $product->product_royalty  = $request->royalty_income;
        $product->product_core_team  = $request->core_team_income;
        $product->product_bonanza_point  = $request->bonanza_point;

        if($product->save()){
            \Session::flash('success','Product successfully updated !');
            return redirect()->route('product.index');
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->destroy($product->id)){
            \Session::flash('success','Product successfully removed !');
            return redirect()->route('product.index');
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
    }
}
