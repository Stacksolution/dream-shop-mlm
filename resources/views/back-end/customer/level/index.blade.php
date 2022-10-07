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
               <h4 class="mb-sm-0 font-size-18">Level Team</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Level Team</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      @foreach($levelcostomer as $key => $data)
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <ul class="nav nav-tabs" role="tablist" id="myTab">
                     @foreach($data->level as $key => $value)
                     <li class="nav-item">
                        <a class="nav-link {{$key == 0 ? 'active':''}}" data-bs-toggle="tab" href="#wallet{{$key}}" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-block">{{$value['levels']}}</span>
                        </a>
                     </li>
                     @endforeach
                  </ul>
                  <div class="tab-content p-3 text-muted">
                     @foreach($data->level as $key => $value)
                     <div class="tab-pane {{$key == 0 ? 'active':''}}" id="wallet{{$key}}" role="tabpanel">
                        <div class="row">
                           <div class="col-12">
                              <table class="table table-bordered dt-responsive nowrap w-100">
                                 <thead>
                                    <tr>
                                       <th>Sr</th>
                                       <th>ID</th>
                                       <th>Referred By</th>
                                       <th>Name</th>
                                       <th>Date</th>
                                       <th>Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($value['users'] as $keys => $values)
                                    <tr>
                                       <td>{{$keys+1}}</td>
                                       <td>{{$values->user_referral}}</td>
                                       @if(!empty($values->referrer))
                                       <td>{{$values->referrer->name }} - {{ $values->referrer->user_mobile }}</td>
                                       @else
                                       <td>--</td>
                                       @endif
                                       <td>{{$values->name}} - {{ $values->user_mobile }}</td>
                                       <td>{{canvert_date($values->created_at)}}</td>
                                       <td>
                                          @if($values->user_id_status == 1)
                                          <span class="badge badge-pill badge-soft-success">Active</span>
                                          @else
                                          <span class="badge badge-pill badge-soft-danger">Pending</span>
                                          @endif
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>
@endsection