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
                     <h4 class="mb-sm-0 font-size-18">Pricing</h4>
                     <div class="page-title-right">
                         <ol class="breadcrumb m-0">
                             <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                             <li class="breadcrumb-item active">Pricing</li>
                         </ol>
                     </div>

                 </div>
             </div>
         </div>
         <!-- end page title -->
         <div class="row justify-content-center">
             <div class="col-lg-6">
                 <div class="text-center mb-5">
                     <h4>Choose your Pricing plan</h4>
                     <p class="text-muted">You can activate your account by subscribing, this is forever for activated your profile and get access all time.</p>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-xl-3 col-md-6" style="margin: 0 auto;">
                 <div class="card plan-box">
                     <div class="card-body p-4">
                         <div class="d-flex">
                             <div class="flex-grow-1">
                                 <h5>Basic</h5>
                                 <p class="text-muted">Subscription Plan</p>
                             </div>
                             <div class="flex-shrink-0 ms-3">
                                 <i class="bx bx-walk h1 text-primary"></i>
                             </div>
                         </div>
                         <div class="py-4">
                             <h2><sup><small>Rs</small></sup> 200/ <span class="font-size-13">Activate</span></h2>
                         </div>
                         <div class="text-center plan-btn">
                             <a href="{{route('plan.payment',[Auth()->user()->id,'pool'])}}" class="btn btn-primary btn-sm waves-effect waves-light">Pay now</a>
                         </div>
                         <div class="plan-features mt-5">
                             <p><i class="bx bx-checkbox-square text-primary me-2"></i> Free Live Support</p>
                             <p><i class="bx bx-checkbox-square text-primary me-2"></i> Unlimited User</p>
                             <p><i class="bx bx-checkbox-square text-primary me-2"></i> Track Team</p>
                             <p><i class="bx bx-checkbox-square text-primary me-2"></i> Free Setup</p>
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