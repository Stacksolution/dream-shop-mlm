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
               <h4 class="mb-sm-0 font-size-18">Binary community</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Binary community</li>
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
                        <h4 class="card-title">Binary community</h4>
                     </div>
                  </div>
                  <div class="row mb-4">
                     <div class="col-lg-12">
                        <form class="row gy-2 gx-3 align-items-center" action="{{route('binary.user.community')}}" method="get">
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
                              <a href="{{route('binary.user.community')}}" class="btn btn-md btn-danger"><i class="bx bx-rotate-left font-size-16 align-middle me-2"></i>Reset</a>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-12" style="overflow-x:auto;">
                        <table class="table table-bordered dt-responsive w-100">
                            <thead>
                                <tr>
                                   <th>Sr</th>
                                   <th>Sponsor by</th>
                                   <th>Name</th>
                                   <th>Date</th>
                                   <th>Status</th>
                                </tr>
                             </thead>
                             <tbody>
                                @foreach($records as $key => $data)
                                <tr>
                                   <td>{{ $key + $records->firstItem() }}</td>
                                   @php  $user = App\Models\User::where('user_referral',$data->user->user_referral_by)->first(); @endphp
                                   <td>{{ $user->user_referral }} <br> {{ $user->name }} <br>{{ $user->user_mobile }}</td>
                                   <td>
                                      <div class="avatar-group-item">
                                         <a href="javascript: void(0);" class="d-inline-block text-dark" value="member-5">
                                         <!-- <img src="{{image_path($data->user_image)}}" alt="{{ $data->name }}" class="rounded-circle avatar-xs"> -->
                                         <span class="mb-1">{{ $data->user->user_referral }} <br> {{ $data->user->name }} <br>{{ $data->user->user_mobile }}</span>
                                         </a>
                                      </div>
                                   </td>
                                   <td>{{ canvert_date($data->created_at) }}</td>
                                   <td>
                                      @if($data->binary_status == "1")
                                      <span class="badge badge-pill badge-soft-success">Active</span>
                                      @else
                                      <span class="badge badge-pill badge-soft-danger">Pending</span>
                                      @endif
                                   </td>
                                </tr>
                                @endforeach
                             </tbody>
                          </table>
                        {{ $records->links('pagination::bootstrap-5') }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection