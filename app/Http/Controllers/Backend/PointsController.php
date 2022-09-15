<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pointvalue;

class PointsController extends Controller
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
       $point = Pointvalue::query();
       $point->where('point_user_id',Auth()->user()->id);
       $point->orderBy('id','desc');
       $points = $point->paginate(10);
       return view('back-end.wallets.points-transaction',compact('points'));
    }	

    public function show(Request $request){
       $point = Pointvalue::query();
       $point->where('point_user_id',$request->point);
       $point->orderBy('id','desc');
       $points = $point->paginate(10);
       return view('back-end.wallets.points-transaction',compact('points'));
    }
}