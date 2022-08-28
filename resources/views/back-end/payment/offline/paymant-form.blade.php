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
               <h4 class="mb-sm-0 font-size-18">Manual transaction</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Manual transaction</li>
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
                        <h4 class="card-title">Manual transaction</h4>
                     </div>
                  </div>
                  <form action="{{ route('subscriprion.update',[Request::segment(4)]) }}" method="POST" class="needs-validation" novalidate>
                     @csrf
                     {{ method_field('PUT') }}
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Transaction ID</label>
                              <div class="input-group" id="contact_name">
                                 <input type="text" class="form-control {{ $errors->has('transaction_id') ? 'is-invalid' : '' }}" placeholder="Enter Transaction ID" name="transaction_id" value="{{ old('transaction_id') }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('transaction_id')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Order ID</label>
                              <div class="input-group" id="text">
                                 <input type="text" class="form-control {{ $errors->has('order_id') ? 'is-invalid' : '' }}" placeholder="Enter Order Id" name="order_id" value="{{ old('order_id') }}">
                                 <span class="input-group-text"><i class="bx bx-voicemail"></i></span>
                              </div>
                              @error('order_id')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Amount</label>
                              <div class="input-group" id="amount">
                                 <input type="text" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" placeholder="Enter amount" name="amount" value="{{ old('amount') }}">
                                 <span class="input-group-text"><i class="bx bx-money"></i></span>
                              </div>
                              @error('amount')
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