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
               <h4 class="mb-sm-0 font-size-18">Team</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Team Records</li>
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
                        <h4 class="card-title">Team Records</h4>
                     </div>
                     <div class="col-md-4 text-right">
                        <div class="card-footer bg-transparent" style="margin-top: -17px;">
                           <div class="text-center">
                              <a href="{{route('customer.create')}}" class="btn btn-outline-primary btn-sm align-middle me-2" title="New Team" style="float: right;"> 
                              <i class="fas fa-plus"></i> New Team
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row mb-4">
                     <div class="col-lg-12">
                        <form class="row gy-2 gx-3 align-items-center" action="{{route('customer.index')}}" method="get">
                           @csrf
                           <div class="col-sm-auto">
                              <label class="visually-hidden" for="autoSizingInput">Keywords</label>
                              <input type="text" class="form-control form-control-md" placeholder="Enter Keywords..." name="search" value="{{$keyword}}">
                           </div>
                           <div class="col-sm-auto">
                            <label class="visually-hidden" for="autoSizingInput">Status</label>
                               <select class="form-control form-control-md" name="status">
                                    <option value="">Select Status</option>
                                    <option value="1" @if($status == 1) {{"selected"}} @endif>Active</option>
                                    <option value="0" @if($status == 0) {{"selected"}} @endif>Pending</option>
                                </select>
                           </div>
                           <div class="col-sm-auto">
                              <button type="submit" class="btn btn-md btn-primary"><i class="bx bx-search font-size-16 align-middle me-2"></i>Search</button>
                           </div>
                           <div class="col-sm-auto">
                              <a href="{{route('customer.index')}}" class="btn btn-md btn-danger"><i class="bx bx-rotate-left font-size-16 align-middle me-2"></i>Reset</a>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-12" style="overflow-x:auto;">
                        <table class="table table-bordered dt-responsive w-100">
                            <thead>
                                <tr>
                                   <th>Sr</th>
                                   <th>ID</th>
                                   <th>Referred By</th>
                                   <th>Name</th>
                                   <th>Date</th>
                                   <th>Direct Team</th>
                                   <th>Status</th>
                                   <th>Action</th>
                                </tr>
                             </thead>
                             <tbody>
                                @foreach($customer as $key => $data)
                                <tr>
                                   <td>{{ $key + $customer->firstItem() }}</td>
                                   <td>{{ $data->user_referral }}</td>
                                   @php  $user = App\Models\User::where('user_referral',$data->user_referral_by)->first(); @endphp
                                   <td>{{ $user->name }} - {{ $user->user_mobile }}</td>
                                   <td>
                                      <div class="avatar-group-item">
                                         <a href="javascript: void(0);" class="d-inline-block text-dark" value="member-5">
                                         <!-- <img src="{{image_path($data->user_image)}}" alt="{{ $data->name }}" class="rounded-circle avatar-xs"> --><span class="mb-1">{{ $data->name }}-{{ $data->user_mobile }}</span>
                                         </a>
                                      </div>
                                   </td>
                                   <td>{{ canvert_date($data->created_at) }}</td>
                                   @php  $count = App\Models\User::where('user_referral_by',$data->user_referral)->count(); @endphp
                                   <td>{{ $count }}</td>
                                   <td>
                                      @if($data->user_id_status == "1")
                                      <span class="badge badge-pill badge-soft-success">Active</span>
                                      @else
                                      <span class="badge badge-pill badge-soft-danger">Pending</span>
                                      @endif
                                   </td>
                                   <td class="text-center">
                                      <div class="dropdown">
                                         <a class="dropdown-toggle btn btn-outline-dark btn-sm" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                         <i class="bx bx-menu font-size-14"></i>
                                         </a>
                                         <div class="dropdown-menu dropdown-menu-end"> 
                                            @if (Auth()->user()->user_type == 'admin')
                                            <a class="dropdown-item" href="{{route('wallets.show',[$data->id])}}"><i class="bx bx-wallet text-dark me-1"></i> Wallets balance</a>
                                            <a class="dropdown-item" href="{{route('wallets.transactions',[$data->id])}}"><i class="bx bx-wallet text-dark me-1"></i> Wallets Transaction</a>
                                            <a class="dropdown-item" href="{{route('bonanza.show',[$data->id])}}"><i class="bx bx-wallet text-dark me-1"></i> Bonanza Transaction</a>
                                            <a class="dropdown-item" href="{{route('point.show',[$data->id])}}"><i class="bx bx-wallet text-dark me-1"></i> Points Transaction</a>
                                            <a class="dropdown-item" href="{{route('rewards.show',[$data->id])}}"><i class="bx bx-wallet text-dark me-1"></i> Rewards Transaction</a>
                                            @if($data->user_id_status == "0")
                                            <a class="dropdown-item" href="{{route('subscriprion.manual',[$data->id])}}"><i class="bx bx-money text-primary me-1"></i>Pool Manual Payment</a>
                                            @endif
                                            @endif
                                            @if($data->user_id_status == "0")
                                            <a class="dropdown-item" href="{{route('plan.payment',[$data->id,'pool'])}}" title="online payment"><i class="bx bxl-paypal text-primary me-1"></i>Pool Online Payment</a>
                                            @endif
                                            <a class="dropdown-item" href="{{route('customer.treeview',[$data->id])}}"><i class="bx bx-street-view text-dark me-1"></i>Network</a>
                                            <a class="dropdown-item" title="Edit" href="{{route('customer.edit',[$data->id])}}"><i class="bx bx-edit text-success me-1"></i>Edit
                                            </a>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                                @endforeach
                             </tbody>
                          </table>
                        {{ $customer->links('pagination::bootstrap-5') }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection