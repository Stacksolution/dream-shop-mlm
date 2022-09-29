@extends('back-end.layouts.app')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Wallets</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Wallets</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xl-4">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex">
                     <div class="me-2">
                        <img class="rounded-circle header-profile-user avatar-md" src="{{ static_asset('back-end/images/users/avatar-1.jpg')}}" alt="Header Avatar">
                     </div>
                     <div class="flex-grow-1">
                        <div class="text-muted">
                           <h5>{{char_limit($customer->name,15)}}</h5>
                           <p class="mb-0 text-primary">{{$customer->user_referral}}</p>
                           <p class="mb-1">{{$customer->email}}</p>
                        </div>
                     </div>
                     <div class="dropdown ms-0">
                        <a class="text-muted dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal font-size-18"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                           <a class="dropdown-item" href="#">Refresh</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body border-top">
                  <div class="row">
                     <div class="col-sm-6">
                        <div>
                           <p class="text-muted mb-2">Available Balance</p>
                           <h5>{{number_formats($balance)}}</h5>
                        </div>
                     </div>
                     @if(Auth()->user()->user_id_status == '0')
                     <div class="col-sm-6">
                        <div class="text-sm-end mt-4 mt-sm-0">
                           <p class="text-muted mb-2">Inactive Balance</p>
                           <h5>{{number_formats()}}<span class="badge bg-danger ms-1 align-bottom">+ 1.3 %</span></h5>
                        </div>
                     </div>
                     @endif
                  </div>
               </div>
               <div class="card-body border-top">
                  <p class="text-muted mb-4">Total</p>
                  <div class="text-center">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="mt-4 mt-sm-0">
                              <div class="font-size-24 text-primary mb-2">
                                 <i class="bx bx-import"></i>
                              </div>
                              <p class="text-muted mb-2">receive</p>
                              <h5>{{number_formats($overall)}}</h5>
                              <div class="mt-3">
                                 <a href="#" class="btn btn-primary btn-sm w-sm">Receive</a>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="mt-4 mt-sm-0">
                              <div class="font-size-24 text-primary mb-2">
                                 <i class="bx bx-wallet"></i>
                              </div>
                              <p class="text-muted mb-2">Withdraw</p>
                              <h5>{{number_formats($withdraw)}}</h5>
                              <div class="mt-3">
                                 <a href="#" class="btn btn-primary btn-sm w-sm">Withdraw</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-8">
            <div class="row">
               <div class="col-md-4">
                  <div class="card mini-stats-wid">
                     <div class="card-body">
                        <div class="d-flex">
                           <div class="flex-grow-1">
                              <p class="text-muted fw-medium">Wallets</p>
                              <h5 class="mb-0">{{number_formats($balance)}}</h5>
                           </div>
                           <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                              <span class="avatar-title rounded-circle bg-primary">
                              <i class="bx bx-wallet font-size-24"></i>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card mini-stats-wid">
                     <div class="card-body">
                        <div class="d-flex">
                           <div class="flex-grow-1">
                              <p class="text-muted fw-medium">Withdraw</p>
                              <h5 class="mb-0">{{number_formats($withdraw)}}</h5>
                           </div>
                           <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                              <span class="avatar-title rounded-circle bg-primary">
                              <i class="bx bx-purchase-tag-alt font-size-24"></i>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
