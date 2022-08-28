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
               <h4 class="mb-sm-0 font-size-18">KYC Documents</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">KYC Records</li>
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
                        <h4 class="card-title">KYC Records</h4>
                     </div>
                  </div>
                  <div class="row mb-4">
                     <div class="col-lg-12">
                        <form class="row gy-2 gx-3 align-items-center" action="{{route('document.index')}}" method="get">
                           @csrf
                           <div class="col-sm-auto">
                              <label class="visually-hidden" for="autoSizingInput">Keywords</label>
                              <input type="text" class="form-control form-control-md" placeholder="Enter Keywords..." name="search" value="{{$keyword}}">
                           </div>
                           <div class="col-sm-auto">
                              <button type="submit" class="btn btn-md btn-primary"><i class="bx bx-search font-size-16 align-middle me-2"></i>Search</button>
                           </div>
                           <div class="col-sm-auto">
                              <a href="{{route('document.index')}}" class="btn btn-md btn-danger"><i class="bx bx-rotate-left font-size-16 align-middle me-2"></i>Reset</a>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-12" style="overflow-x:auto;">
                     <table class="table table-bordered dt-responsive w-100">
                        <thead>
                           <tr>
                              <th>Sr</th>
                              <th>Name</th>
                              <th>Date</th>
                              <th>Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($customer as $key => $data)
                           <tr>
                              <td>{{ $key + $customer->firstItem() }}</td>
                              <td>
                                 <div class="avatar-group-item">
                                    <a href="javascript: void(0);" class="d-inline-block text-dark" value="member-5"><span class="mb-1">{{ $data->name }}-{{ $data->user_mobile }}</span>
                                    </a>
                                 </div>
                              </td>
                              <td>{{ canvert_date($data->created_at) }}</td>
                              <td>
                                 @php $status = App\Models\Document::document_status($data->id);  @endphp
                                 <span class="badge badge-pill badge-soft-info">{{ucfirst($status)}}</span>
                              </td>
                              <td class="text-center">
                                 <a class="btn btn-outline-secondary btn-sm" title="Edit" href="{{route('document.show',[$data->id])}}">
                                 <i class="fas fa-eye"></i>
                                 </a>
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