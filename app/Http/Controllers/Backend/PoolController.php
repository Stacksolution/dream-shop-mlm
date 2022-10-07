<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PoolMatrixCustomer;
use App\Models\Poolstab;
use App\Models\UserPoolslab;
use App\Utility\PoolsUtility;
use App\Utility\CronsUtility;

class PoolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('activation');
    }

    public function index(Request $request){
      
    }

    public function create(Request $request){
        return view('back-end.customer.pool.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|string',
            'amount' => 'required|numeric',
            'member' => 'required|numeric',
        ]);
        $poolstab = new Poolstab();
        $poolstab->slab_name = $request->name;
        $poolstab->slab_user_target = $request->member;
        $poolstab->slab_amount = $request->amount;
        if($poolstab->save()){
            \Session::flash('success','Slab added successfully !');
            return back();
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
    }
    
    public function update(Request $request){

    }
    /**
     * this method use for show details
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request){

    }

    /**
     * Show the user wise tree by user referral code.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function treeView(Request $request)
    {   
        if(Auth()->user()->user_type != "admin"){
           $user =  User::findOrFail($request->id);
        }else{
           $user =  Auth()->user();
        }
        $customer = PoolMatrixCustomer::tree_users($user);
        return view('back-end.customer.pool.index',compact('customer'));
    }

    public function slabs(Request $request){
        $user =  Auth()->user();
        $poolstab = UserPoolslab::where('slab_user_id',$user->id)->paginate(10);
        return view('back-end.customer.pool.slabs',compact('poolstab'));
    }
}
