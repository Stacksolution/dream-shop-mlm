<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PoolMatrixCustomer;
use App\Utility\PoolsUtility;

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

    }

    public function store(Request $request){

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

    public function cron(){
        foreach (User::all() as $key => $value) {
            $users = PoolMatrixCustomer::where('pmc_parent_id',$value->id)->get();
            $total_counts =  count($users);
            foreach ($users as $key => $values) {
                $total_counts += $this->getCount($values);
            }
            echo $total_counts.'<br>';
        }
    }
    //
    public function getCount($users){
        $users = PoolMatrixCustomer::where('pmc_parent_id',$users->id)->get();
        $total_counts =  count($users);
        foreach ($users as $key => $values) {
            $total_counts += $this->getCount($values);
        }
        return $total_counts;
    }
}
