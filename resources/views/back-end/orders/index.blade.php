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
               <h4 class="mb-sm-0 font-size-18">Packages</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Activated Packages</li>
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
                        <h4 class="card-title">Activated Packages</h4>
                     </div>
                  </div>
                  <div class="col-12" style="overflow-x:auto;">
                     <table class="table table-bordered dt-responsive w-100">
                        <thead>
                           <tr>
                              <th>Sr</th>
                              <th>Price</th>
                              <th>Date</th>
                              <th>Payemnt(status)</th>
                              <th>Payemnt(mode)</th>
                              @if (Auth()->user()->user_type == 'admin') 
                              <th>Action</th>
                              @endif
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($orders as $key => $data)
                           <tr>
                              <td>{{ $key + $orders->firstItem() }}</td>
                              <td>{{number_formats($data->order_total)}}</td>
                              <td>{{canvert_date($data->created_at)}}</td>
                              <td>
                                 @if($data->order_payment_status == 'paid')
                                 <span class="badge badge-pill badge-soft-success font-size-11">paid</span>
                                 @else
                                 <span class="badge badge-pill badge-soft-danger font-size-11">unpaid</span>
                                 @endif
                              </td>
                              <td>{{$data->order_payment_mode}}</td>
                              @if (Auth()->user()->user_type == 'admin') 
                              <td>
                                 <div class="dropdown">
                                      <a class="dropdown-toggle btn btn-outline-dark btn-sm" role="button" data-bs-toggle="dropdown" aria-haspopup="true"><i class="bx bx-menu font-size-14"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-end">  
                                          <a class="dropdown-item" title="Edit" href="">
                                             <i class="bx bx-file me-1"></i> View
                                          </a>
                                          <a class="dropdown-item" title="Edit" href="">
                                             <i class="bx bx-file me-1"></i> Invoice
                                          </a>
                                      </div>
                                  </div>
                              </td>
                              @endif
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     {{ $orders->links('pagination::bootstrap-5') }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection