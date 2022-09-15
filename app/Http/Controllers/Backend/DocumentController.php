<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utility\ActivetionUtility;
use App\Models\Document;
use File;
use App\Models\User;

class DocumentController extends Controller{

	public function index(Request $request){
		$customer = User::query()->with('doscuments');
        $customer->where('user_type','customer');
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
        return view('back-end.dcoument.index',compact('customer','keyword'));
	}

	public function create(Request $request){
		$user_id = Auth()->user()->id;
		$adhaar = Document::where('document_name','adhaar')->where('document_user_id',$user_id)->first();
		$pan = Document::where('document_name','pan')->where('document_user_id',$user_id)->first();
		return view('back-end.dcoument.create',compact('adhaar','pan'));
	}

	public function uploadAadhaar(Request $request){
		$validated = $request->validate([
            'aadhar_number' => 'required|min:12|max:12',
            'aadhar_front' => 'required|image|mimes:jpeg,jpg,png',
            'aadhar_back' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        $user_id = Auth()->user()->id;
		$getAdhaar = Document::where('document_name','adhaar')->where('document_user_id',$user_id)->first();

		$adhaar = new Document();
		if(!empty($getAdhaar)){
			$adhaar = Document::findOrFail($getAdhaar->id);
			File::delete(public_path($adhaar->document_front_image));
			File::delete(public_path($adhaar->document_back_image));
		}

		
		$adhaar->document_id_number = $request->aadhar_number;
		$adhaar->document_name   = 'adhaar';
		$adhaar->document_user_id = $user_id;

		$document_path = 'uploads/document/user-'.$user_id;
		if(!File::exists($document_path)) {
		   File::makeDirectory($document_path,0777, true, true);

		}

		$front_image = $request->file('aadhar_front')->getClientOriginalName();
		$aadhar_front_path = $request->file('aadhar_front')->store($document_path,'public');
		$adhaar->document_front_image = $aadhar_front_path;

		$aadhar_back = $request->file('aadhar_back')->getClientOriginalName();
		$aadhar_back_path = $request->file('aadhar_back')->store($document_path,'public');
		$adhaar->document_back_image = $aadhar_back_path;
		$adhaar->save();

		if($adhaar->save()){
            \Session::flash('success','Document uploads successfully !');
            return back();
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
	}

	public function uploadPan(Request $request){
		$validated = $request->validate([
            'pan_number' => 'required|min:10|max:10|alpha_num',
            'pan_front' => 'required|image|mimes:jpeg,jpg,png'
        ]);

		$document_path = 'uploads/document/user-'.Auth()->user()->id;
		if(!File::exists($document_path)) {
		   File::makeDirectory($document_path,0777, true, true);
		}

		$user_id = Auth()->user()->id;
		$getPan = Document::where('document_name','pan')->where('document_user_id',$user_id)->first();

		$pan = new Document();
		if(!empty($getPan)){
			$pan = Document::findOrFail($getPan->id);
			File::delete(public_path($getPan->document_front_image));
		}

		
		$pan->document_id_number = $request->pan_number;
		$pan->document_user_id = $user_id;
		$pan->document_status = 0;
		$pan->document_name   = 'pan';
		$front_image = $request->file('pan_front')->getClientOriginalName();
		$pan_front_path = $request->file('pan_front')->store($document_path,'public');
		$pan->document_front_image = $pan_front_path;

		if($pan->save()){
            \Session::flash('success','Document uploads successfully !');
             return back();
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
	}

	public function show(Request $request){
		$document = Document::where('document_user_id',$request->document)->get();
		return view('back-end.dcoument.view',compact('document'));
	}

	public function updateStatus(Request $request){
		$document = Document::findOrFail($request->id);
		$document->document_status = $request->status;
		if($document->save()){
            \Session::flash('success','Document updated successfully !');
             return back();
        }else{
            \Session::flash('error','Oops something went wrong !');
            return back();
        }
	}
}