<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utility\ActivetionUtility;

class InviteController extends Controller
{
	public function index(Request $request){
		return view('back-end.invite.invite-page');
	}	
}