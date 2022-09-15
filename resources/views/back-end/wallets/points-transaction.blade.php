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
               <h4 class="mb-sm-0 font-size-18">Points Transactions</h4>
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
                        <h4 class="card-title">Points Transactions</h4>
                     </div>
                     <div class="col-md-4 text-right">
                        
                     </div>
                  </div>
                  <div class="col-12" style="overflow-x:auto;">                     
                     <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                           <tr>
                              <th>Sr</th>
                              <th>Transaction id</th>
                              <th>Points</th>
                              <th>Position</th>
                              <th>Date</th>
                              <th>Remark</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($points as $key => $data)
                           <tr>
                              <td>{{ $key + $points->firstItem() }}</td>
                              <td>{{$data->point_transaction_id}}</td>
                              <td>{{number_formats($data->point_value)}}</td>
                              <td>{{$data->point_value_side == "R"? "RIGHT":"LEFT"}}</td>
                              <td>{{canvert_date($data->created_at)}}</td>
                              <td>{{ $data->point_description }}</td>
                              <td>
                                 @if($data->point_type == '1')
                                 <span class="badge badge-pill badge-soft-success font-size-11">CR</span>
                                 @else
                                 <span class="badge badge-pill badge-soft-danger font-size-11">DR</span>
                                 @endif
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     {{ $points->links('pagination::bootstrap-5') }}    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection