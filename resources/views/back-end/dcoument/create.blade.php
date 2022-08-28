@extends('back-end.layouts.app')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Upload Document</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Upload Document</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <div class="row">
         <div class="col-12">
            <div class="card border border-info">
               <div class="card-body">
                  <p class="card-text">KYC process includes Aadhaar card & PAN card  verification {{ env('APP_NAME') }} must comply with KYC regulations and payout regulations to limit fraud.</p>
               </div>
            </div>
         </div>
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="row mb-4">
                     <div class="col-md-8">
                        <h4 class="card-title">Upload Aadhaar Card</h4>
                     </div>
                  </div>
                  @if(!empty($adhaar))
                  @if($adhaar->document_status == 0 ||
                  $adhaar->document_status == 1 )
                  <div class="col-12">
                     <div class="card border border-info">
                        <div class="card-body">
                           <p class="card-text">Your Aadhaar Card Kyc {{ $adhaar->document_status == 1 ? "Is Completed and Approved !" : " Is Pending For Approval"}}</p>
                        </div>
                     </div>
                  </div>
                  @endif
                  @endif
                  @if(empty($adhaar) || @$adhaar->document_status == 2)
                  <form action="{{ route('upload.aadhaar') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                        <div class="col-md-4">
                           <div class="mb-4">
                              <label>Aadhaar Number</label>
                              <div class="input-group" id="contact_name">
                                 <input type="text" class="form-control {{ $errors->has('aadhar_number') ? 'is-invalid' : '' }}" placeholder="Enter Aadhaar Number" name="aadhar_number" value="{{ old('aadhar_number') }}">
                                 <span class="input-group-text"><i class="bx bxs-bank"></i></span>
                              </div>
                              @error('aadhar_number')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="mb-4">
                              <label>Aadhaar front</label>
                              <div class="input-group">
                                 <input type="file" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="aadhar_front" value="{{ old('aadhar_front') }}">
                              </div>
                              @error('aadhar_front')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="mb-4">
                              <label>Aadhaar Back</label>
                              <div class="input-group">
                                 <input type="file" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="aadhar_back" value="{{ old('aadhar_back',@$adhaar->document_id_number) }}">
                              </div>
                              @error('aadhar_back')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="mt-2">
                        <button class="btn btn-primary" type="submit">Upload</button>
                     </div>
                  </form>
                  @endif
               </div>
            </div>
         </div>
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="row mb-4">
                     <div class="col-md-8">
                        <h4 class="card-title">Upload Pan Card</h4>
                     </div>
                  </div>
                  @if(empty($pan) || @$pan->document_status == 2)
                  <form action="{{ route('upload.pan') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                        <div class="col-md-4">
                           <div class="mb-4">
                              <label>Pan Number</label>
                              <div class="input-group">
                                 <input type="text" class="form-control {{ $errors->has('pan_number') ? 'is-invalid' : '' }}" placeholder="Enter Pan Number" name="pan_number" value="{{ old('pan_number',@$pan->document_id_number) }}">
                                 <span class="input-group-text"><i class="bx bxs-bank"></i></span>
                              </div>
                              @error('pan_number')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="mb-4">
                              <label>Pan front</label>
                              <div class="input-group">
                                 <input type="file" class="form-control {{ $errors->has('pan_front') ? 'is-invalid' : '' }}" name="pan_front" value="{{ old('pan_front') }}">
                              </div>
                              @error('pan_front')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="mt-2">
                        <button class="btn btn-primary" type="submit">Upload</button>
                     </div>
                  </form>
                  @endif
                  @if(!empty($pan))
                  @if($pan->document_status == 0 ||
                  $pan->document_status == 1 )
                  <div class="col-12">
                     <div class="card border border-info">
                        <div class="card-body">
                           <p class="card-text">Your PAN Card Kyc {{$pan->document_status == 1 ? "Is Completed and Approved !" : " Is Pending For Approval"}}</p>
                        </div>
                     </div>
                  </div>
                  @endif
                  @endif
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