<?php

namespace App\Http\Controllers\Backend;

use Session;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customers;
use App\Models\PoolMatrixCustomer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Utility\PoolsUtility;
use App\Models\Wallets;



class CustomerController extends Controller
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
    /**
     * Show the application back office dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        $customer = User::query();
        if (Auth()->user()->user_type != 'admin') {
            $customer->where('user_referral_by',Auth()->user()->user_referral);
        }
        $status = '';
        if($request->has('status')){
           $status = $request->status;
           $customer->where('user_id_status',$status);
        }

        $customer->where('user_type','customer');
        $customer->orderBy('id','desc');
        $keyword = '';
        if($request->has('search')){
           $keyword = $request->search;
           $customer->where(function ($q) use ($keyword){
                $q->orWhere('name', 'like', '%'.$keyword.'%')
                ->orWhere('email', 'like', '%'.$keyword.'%')
                ->orWhere('user_mobile', 'like', '%'.$keyword.'%');
            });
        }
        $customer = $customer->paginate(10);
        return view('back-end.customer.index',compact('customer','keyword','status'));
    }
    /**
     * Show the user 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request)
    {   
        
    }
    /**
     * Store user Or create
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {   
        return view('back-end.customer.create');
    }
    /**
     * edit user by id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request)
    {   
        $customer = User::findOrFail($request->customer);
        return view('back-end.customer.edit',compact('customer'));
    }
    /**
     * Store user Or create
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {   
        
        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|unique:users,user_mobile|min:10',
            'member_id' => 'required|min:6',
        ]);
        $user = new User();
        $user->user_referral = strtoupper(Str::random(6));
        $user->user_referral_by = $request->member_id;
        $user->user_mobile = $request->mobile;
        $user->name = $request->name;
        $user->user_type = 'customer';
        $user->password  = Hash::make($user->user_referral);
        $user->email  = $request->email;
        if($user->save()){
            PoolsUtility::pool_matrix_customers_create($user);
            $customer  = new Customers(); 
            $customer->user_id  = $user->id;
            $customer->save();
            return back();
        }else{
            return back();
        }
    }
    /**
     * update user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,'.$request->customer,
            'mobile' => 'required|min:10|unique:users,user_mobile,'.$request->customer
        ]);
        $user = User::findOrFail($request->customer);
        $user->user_mobile = $request->mobile;
        $user->name = $request->name;
        $user->email  = $request->email;
        
        if($request->has('password')){
            $user->password  = Hash::make($request->password);
        }

        if($user->save()){
            \Session::flash('success','Profile updated successfully !');
            return back();
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
    }
    /**
     * delete user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Request $request)
    {   
        
    }
    /**
     * Show the user profile by id 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(Request $request)
    {   
        $user_id = Auth()->user()->id; 
        $customer = User::findOrFail($user_id);
        $balance  = Wallets::balance($user_id);
        $withdraw = Wallets::withdraw($user_id);
        $overall  = Wallets::overall($user_id);
        return view('back-end.profile.index',compact('customer','balance','withdraw','overall'));
    }

    public function levels(Request $request){
        $user_id = Auth()->user()->id; 
        $levelcostomer = User::user_tree_level($user_id);
        return view('back-end.customer.level.index',compact('levelcostomer'));
    }
}
