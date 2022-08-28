@extends('back-end.layouts.app')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">View Document</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">View Document</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <div class="row mb-4">
                     <div class="col-md-8">
                        <h4 class="card-title">KYC Verification Document</h4>
                     </div>
                  </div>
                  <div class="row">
                     @foreach($document as $key => $data)
                        @if(!empty($data->document_front_image))
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-6">
                                 <h4 class="card-title">{{ strtoupper($data->document_name)}} (Front)</h4>
                                 <p class="badge badge-soft-dark font-size-12 p-2">
                                    {{$data->document_id_number}}
                                 </p>
                              </div>
                              <div class="col-md-6">
                                 <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-menu m-0 font-size-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                       <a class="dropdown-item deletetask" href="{{route('update.status',['1',$data->id])}}">Approved</a>
                                       <a class="dropdown-item deletetask" href="{{route('update.status',['2',$data->id])}}">Reject</a>
                                    </div>
                                 </div>
                                 <div class="mr-10">
                                    @if($data->document_status == 1)
                                    <span class="badge badge-soft-success font-size-12" id="task-status">Approved</span>
                                    @elseif($data->document_status == 2)
                                    <span class="badge badge-soft-danger font-size-12" id="task-status">Cancel</span>
                                    @elseif($data->document_status == 0)
                                    <span class="badge badge-soft-info font-size-12" id="task-status">Pending</span>
                                    @endif
                                 </div>
                              </div>
                           </div>
                           <img class="rounded me-2" alt="200x200" width="300" src="{{static_asset($data->document_front_image)}}" data-holder-rendered="true">
                        </div>
                        @endif
                        @if(!empty($data->document_back_image))
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-6">
                                 <h4 class="card-title">(Back)</h4>
                                 <p class="card-title-desc">
                                 </p>
                              </div>
                           </div>
                           <img class="rounded me-2 mt-4" alt="200x200" width="300" src="{{static_asset($data->document_back_image)}}" data-holder-rendered="true">
                        </div>
                        @endif
                     <hr class="mt-3">
                     @endforeach

                     @if(count($document) <= 0)
                     <div class="text-center">
                       <div class="row justify-content-center">
                           <div class="col-lg-10">
                               <h4 class="mt-4 fw-semibold">KYC Verification</h4>
                               <p class="text-muted mt-3">Itaque earum rerum hic tenetur a sapiente delectus ut aut reiciendis perferendis asperiores repellat.</p>
                               <div class="mt-4">
                                   <!-- Button trigger modal -->
                                   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verificationModal">
                                       Click here for Verification
                                   </button>
                               </div>
                           </div>
                       </div>
                       <div class="row justify-content-center mt-5 mb-2">
                           <div class="col-sm-6 col-8">
                               <div>
                                   <img src="{{static_asset('back-end/images/verification-img.png')}}" alt="" class="img-fluid">
                               </div>
                           </div>
                        </div>
                     </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection