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
               <h4 class="mb-sm-0 font-size-18">Bank Accounts</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Bank Accounts</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <div class="row mb-4">
         <div class="col-lg-12">
            <form class="row gy-2 gx-3 align-items-center" action="{{route('bank.index')}}" method="get">
               @csrf
               <div class="col-sm-auto">
                  <label class="visually-hidden" for="autoSizingInput">Keywords</label>
                  <input type="text" class="form-control form-control-md" placeholder="Enter Keywords..." name="search" value="{{$keyword}}">
               </div>
               <div class="col-sm-auto">
                   <label class="visually-hidden" for="autoSizingInput">Status</label>
                   <select class="form-control form-control-md" name="status">
                        <option value="">Select Status</option>
                        <option value="0" @if($status == 0) {{"selected"}} @endif>Pending</option>
                        <option value="1" @if($status == 1) {{"selected"}} @endif>Active</option>
                        <option value="2" @if($status == 2) {{"selected"}} @endif>Rejected</option>
                    </select>
               </div>
               <div class="col-sm-auto">
                  <button type="submit" class="btn btn-md btn-primary"><i class="bx bx-search font-size-16 align-middle me-2"></i>Search</button>
               </div>
               <div class="col-sm-auto">
                  <a href="{{route('bank.index')}}" class="btn btn-md btn-danger"><i class="bx bx-rotate-left font-size-16 align-middle me-2"></i>Reset</a>
               </div>
            </form>
         </div>
      </div>
      <div class="row">
         @foreach($bank as $key => $data)
         <div class="col-xl-4">
            <div class="card border  @if($data->bank_is_default == 1) {{'border-success'}} @endif">
               <div class="card-body">
                  @if($data->bank_status != 1)
                  <div class="float-end dropdown ms-2">
                     <a class="text-muted dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="mdi mdi-dots-horizontal font-size-18"></i>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end" style="">
                         <a class="dropdown-item" href="{{route('bank.edit',[$data->id])}}">Edit</a>
                         <a class="dropdown-item" href="{{route('bank.remove',[$data->id])}}">Remove</a>
                     </div>
                  </div>
                  @endif
                  @if(Auth()->user()->user_type == 'admin')
                  <div class="float-end dropdown ms-2">
                     <a class="text-muted dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="mdi mdi-dots-horizontal font-size-18"></i>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end" style="">
                         <a class="dropdown-item" href="{{route('bank.edit',[$data->id])}}">Edit</a>
                     </div>
                  </div>
                  @endif
                  <div>
                     <div class="mb-4 me-3">
                        <div class="avatar-sm mx-auto mb-3 mt-1">
                           <span class="avatar-title rounded-circle @if($data->bank_is_default == 1) {{'bg-success'}} @endif  bg-soft text-primary font-size-16">
                           <i class="bx bxs-bank font-size-18"></i>
                           </span>
                        </div>
                     </div>
                     @if($data->bank_status == 1 || $data->bank_status == 0)
                     <div class="text-center mb-2">
                        @if($data->bank_status == 1)
                        <h5 class="my-0 text-success"><i class="mdi mdi-check-all me-3"></i>Account Approved</h5>
                        @elseif($data->bank_status == 0)
                        <h5 class="my-0 text-info"><i class="mdi mdi-block-helper me-3"></i>Account Pending</h5>
                        @endif
                     </div>
                     <table class="table table-bordered dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>AC/H</th>
                                <td>{{$data->bank_account_holder}}</td>
                            </tr>
                            <tr>
                                <th>AC</th>
                                <td>{{$data->bank_account_number}}</td>
                            </tr>
                            <tr>
                                <th>BANK</th>
                                <td>{{$data->bank_name}}</td>
                            </tr>
                            <tr>
                                <th>IFSC</th>
                                <td>{{$data->bank_ifsc}}</td>
                            </tr>
                            <tr>
                                <th>Beneficiary ID</th>
                                <td>{{ $data->bank_beneficiary }}</td>
                            </tr>
                            <tr>
                                <th>MOBILE</th>
                                <td>{{$data->bank_mobile_number}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{$data->bank_address}}</td>
                            </tr>
                        </thead>
                     </table>
                     @else
                     <div class="card border border-danger">
                         <div class="card-header bg-transparent border-danger">
                             <h5 class="my-0 text-danger"><i class="mdi mdi-block-helper me-3"></i>Account rejected</h5>
                         </div>
                         <div class="card-body">
                             <p class="card-text">Your bank account verification request was rejected. upload your bank details and wait for bank account approval !</p>
                         </div>
                     </div>
                     @endif
                  </div>
               </div>
               <!-- <div class="card-body border-top">
                  <div class="row">
                     <div class="col-sm-6">
                        <div>
                           <p class="fw-medium mb-2">Balance :</p>
                           <h4>$ 6134.39</h4>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="mt-4 mt-sm-0">
                           <p class="fw-medium mb-2">Coin :</p>
                        </div>
                     </div>
                  </div>
               </div> -->
               <div class="card-footer bg-transparent border-top">
                  <div class="text-center">
                     <a href="#" class="btn btn-sm btn-outline-light">Set As Primary</a>
                     @if(Auth()->user()->user_type == 'admin')
                     <a href="{{route('bank.status.update',[$data->id,'2'])}}" class="btn btn-sm btn-outline-danger">Reject</a>
                     <a href="{{route('bank.status.update',[$data->id,'1'])}}" class="btn btn-sm btn-outline-success">Approved</a>
                     @endif
                  </div>
               </div>
            </div>
         </div>
         @endforeach
         @if(Auth()->user()->user_type != 'admin')
         <div class="col-xl-4">
            <div class="card">
               <div class="card-footer bg-transparent border-top">
                  <div class="text-center">
                     <a href="{{route('bank.create')}}" class="btn btn-sm btn-outline-dark me-2 w-md">Add New Bank</a>
                  </div>
               </div>
            </div>
         </div>
         @endif
      </div>
      {{ $bank->links('pagination::bootstrap-5') }}
   </div>
</div>
@endsection