@extends('back-end.layouts.app')
@section('header')
<link href="{{ static_asset('back-end/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ static_asset('back-end/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-12">
                 <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                     <h4 class="mb-sm-0 font-size-18">Welcome</h4>
                     <div class="page-title-right">
                         <ol class="breadcrumb m-0">
                             <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                             <li class="breadcrumb-item active">Welcome</li>
                         </ol>
                     </div>

                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-xl-12 col-md-12 col-sm-12">
                 <div class="card plan-box">
                     <div class="card-body p-4">
                        <div class="row justify-content-center">
                             <div class="col-lg-11">
                                 <div class="text-center mb-5">
                                     <h4>WELCOME LETTER</h4>
                                 </div>
                                 <p>Dear <b>{{Auth()->user()->name}}</b>,</p>
                                 <p class="mt-3 mb-4">
                                     Welcome to <b>{{env('APP_NAME')}}</b> this is to confirm your Free Reistration using <b>{{Auth()->user()->user_referral}}</b> has been created successfully. Now You can start Sponsoring & Referring your contacts to share the wonderful opportunity. Your information as bellow.
                                 </p>
                                 <table class="table table-bordered dt-responsive w-100 mt-3">
                                   <tbody>
                                       <tr>
                                           <th>Sponsor ID</th>
                                           <td><b>{{Auth()->user()->user_referral}}</b></td>
                                       </tr>
                                       <tr>
                                           <th>Name</th>
                                           <td>{{Auth()->user()->name}}</td>
                                       </tr>
                                       <tr>
                                           <th>Mobile</th>
                                           <td>{{Auth()->user()->user_mobile}}</td>
                                       </tr>
                                       <tr>
                                           <th>E-mail</th>
                                           <td>{{Auth()->user()->email}}</td>
                                       </tr>
                                       <tr>
                                           <th>Date</th>
                                           <td>{{Auth()->user()->created_at}}</td>
                                       </tr>
                                       <tr>
                                           <th>Sponsor URL</th>
                                           <td>{{route('user.signup','source_id='.Auth()->user()->user_referral)}}</td>
                                       </tr>
                                   </tbody>
                                </table>
                                <p class="mt-3">
                                   Assuming you of the best service always and wishing you continued success in your journey with <b>{{env('APP_NAME')}}</b> forward with contcts or friends
                                </p>

                                <p class="mt-8">
                                   Regards <br><b>{{env('APP_NAME')}}</b>
                                </p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection
@section('script')
<script src="{{ static_asset('back-end/js/pages/form-validation.init.js')}}"></script>
@endsection