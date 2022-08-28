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
               <h4 class="mb-sm-0 font-size-18">Profile</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Profile update</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="row mb-4">
                     <div class="col-md-8">
                        <h4 class="card-title">Profile update</h4>
                     </div>
                  </div>
                  <form action="{{ route('customer.update',[$customer->id]) }}" method="post" class="needs-validation" novalidate>
                     @csrf
                     {{ method_field('PUT') }}
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Name</label>
                              <div class="input-group" id="contact_name">
                                 <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter name" name="name" value="{{ $customer->name }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('name')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Email</label>
                              <div class="input-group" id="email">
                                 <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Enter name" name="email" value="{{ $customer->email }}">
                                 <span class="input-group-text"><i class="bx bx-voicemail"></i></span>
                              </div>
                              @error('email')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Mobile</label>
                              <div class="input-group" id="user_mobile">
                                 <input type="text" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" placeholder="Enter phone number" name="mobile" value="{{ $customer->user_mobile }}">
                                 <span class="input-group-text"><i class="bx bx-phone"></i></span>
                              </div>
                              @error('mobile')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Password</label>
                              <div class="input-group" id="user_mobile">
                                 <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Enter password" name="password" >
                                 <span class="input-group-text"><i class="bx bx-code"></i></span>
                              </div>
                              @error('password')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div>
                        <button class="btn btn-primary" type="submit">Save</button>
                     </div>
                  </form>
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