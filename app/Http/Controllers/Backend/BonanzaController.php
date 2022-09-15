<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bonanzavalue;

class BonanzaController extends Controller
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
       $bonanza = Bonanzavalue::query();
       $bonanza->where('bonanza_user_id',Auth()->user()->id);
       $bonanza->orderBy('id','desc');
       $bonanzas = $bonanza->paginate(10);
       return view('back-end.wallets.bonanza-transaction',compact('bonanzas'));
    }	

    public function show(Request $request){
       $bonanza = Bonanzavalue::query();
       $bonanza->where('bonanza_user_id',$request->bonanza);
       $bonanza->orderBy('id','desc');
       $bonanzas = $bonanza->paginate(10);
       return view('back-end.wallets.bonanza-transaction',compact('bonanzas'));
    }
}