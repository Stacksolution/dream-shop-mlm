<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Binary;
use App\Models\User;

class BinaryController extends Controller
{	
	public function index(Request $request){
		$records = Binary::level_users(Auth()->user());
		return view('back-end.customer.binary.index',compact('records'));
	}

	public function create(Request $request){
		$sponsor = '';
		if($request->has('sponsor_id')){
			$sponsor = User::where('user_referral',$request->sponsor_id)->first();
		}

		$parents = '';
		if($request->has('parents_id')){
			$parents = User::where('user_referral',$request->parents_id)->first();
		}

		$member = '';
		if($request->has('member_id')){
			$member = User::where('user_referral',$request->member_id)->first();
		}

		return view('back-end.customer.binary.create',compact('parents','member','sponsor'));
	}	


	public function store(Request $request){
		$validated = $request->validate([
            'parents_id' => 'required|min:6|max:6',
            'sponsor_id' => 'required|min:6|max:6',
            'member_id' => 'required|min:6|max:6|unique:binaries,binary_referral',
            'position' => 'required',
        ]);
		$member  = User::where('user_referral',$request->member_id)->first();
        $sponsor = User::where('user_referral',$request->sponsor_id)->first();
        $parents = User::where('user_referral',$request->parents_id)->first();

        $binary = new Binary();
        $binary->binary_user_id   = $member->id;
        $binary->binary_parent_id = $parents->id;
        $binary->binary_referral  = $request->member_id;
        $binary->binary_referral_by = $request->parents_id;
        $binary->binary_user_side = $request->position;
        $binary->binary_sponsor_id = $sponsor->id;
        $binary->binary_status = 0;

		if($binary->save()){
            \Session::flash('success','Binary Plan successfully added !');
            return redirect()->route('binary.index');
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
	}

	public function show(Request $request){
		$users = User::find($request->binary);
		$records = Binary::level_users($users);
		return view('back-end.customer.binary.index',compact('records'));
	}
}