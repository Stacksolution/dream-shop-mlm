<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\SignupEmail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {       
        return view('front-end.home-page');
    }
    /**
     * Show the application user login page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user_login(){
        return view('front-end.auth.login-page');
    }

    /**
     * Show the application user signup page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user_signup(Request $request){
        $metadata = array('meta_title'=>'','meta_description'=>'');
        if(!empty($request->get('source_id'))){
            $user = User::where('user_referral',$request->get('source_id'))->first();
            $name =  env('APP_NAME');
            if(!empty($user)){
                $name = $user->name;
            }
            $metadata = array('meta_title'=>'Join with '.$name.' and making online income with '.env('APP_NAME').' !','meta_description'=>'
                Join with '.$name.' and making online income with '.env('APP_NAME').'! 

                Just active profile ₹ 2100 and get upto ₹100 cashback And every user registration get up to ₹ 40 commission ');
        }
        $source_id = $request->get('source_id');
        return view('front-end.auth.signup-page',compact('metadata','source_id'));
    }
}
