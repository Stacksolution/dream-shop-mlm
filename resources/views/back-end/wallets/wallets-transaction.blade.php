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
               <h4 class="mb-sm-0 font-size-18">Wallets Transactions</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Transactions</li>
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
                        <h4 class="card-title">Wallets Transactions</h4>
                     </div>
                     @if(Auth()->user()->user_type == 'admin')
                     <div class="col-md-4 text-right">
                         <div class="card-footer bg-transparent" style="margin-top: -17px;">
                           <div class="text-center">
                              <a href="{{route('wallets.debitcredit',[$user_id])}}" class="btn btn-outline-primary btn-sm align-middle me-2" title="New Team" style="float: right;"> 
                              <i class="fas fa-plus"></i> Debit / Credit
                              </a>
                           </div>
                        </div>
                     </div>
                     @else 
                     <div class="col-md-4 text-right">
                         <div class="card-footer bg-transparent" style="margin-top: -17px;">
                           <div class="text-center">
                              <a href="{{route('wallets.recharge',[Auth()->user()->id])}}" class="btn btn-outline-primary btn-sm align-middle me-2" title="New Team" style="float: right;"> 
                              <i class="fas fa-plus"></i> Recharge
                              </a>
                           </div>
                        </div>
                     </div>
                     @endif
                  </div>
                  <div class="col-12" style="overflow-x:auto;">                     
                     <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                           <tr>
                              <th>Sr</th>
                              <th>ID</th>
                              <th>Amount</th>
                              <th>TDS(Charge)</th>
                              <th>Sedrvice(Charge)</th>
                              <th>Date</th>
                              <th>Remark</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($wallets as $key => $data)
                           <tr>
                              <td>{{ $key + $wallets->firstItem() }}</td>
                              <td>{{
                                 $data->wallet_transaction_id}}
                              </td>
                              <td>{{number_formats($data->wallet_amount)}}</td>
                              <td>{{number_formats($data->wallet_tds_charge)}}</td>
                              <td>{{number_formats($data->wallet_service_charge)}}</td>
                              <td>{{canvert_date($data->created_at)}}</td>
                              <td>{{ $data->wallet_description }}</td>
                              <td>
                                 @if($data->wallet_type == '1')
                                 <span class="badge badge-pill badge-soft-success font-size-11">CR</span>
                                 @else
                                 <span class="badge badge-pill badge-soft-danger font-size-11">DR</span>
                                 @endif
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     {{ $wallets->links('pagination::bootstrap-5') }}    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection