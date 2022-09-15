<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rewardsvalue;

class RewardsController extends Controller
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
     * Show the application back office wallets by users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {  
       $reward = Rewardsvalue::query();
       $reward->where('rewards_user_id',Auth()->user()->id);
       $reward->orderBy('id','desc');
       $rewards = $reward->paginate(10);
       return view('back-end.wallets.rewards-transaction',compact('rewards'));
    }	

    public function show(Request $request){
       $reward = Rewardsvalue::query();
       $reward->where('rewards_user_id',$request->rewards);
       $reward->orderBy('id','desc');
       $rewards = $reward->paginate(10);
       return view('back-end.wallets.rewards-transaction',compact('rewards'));
    }
}