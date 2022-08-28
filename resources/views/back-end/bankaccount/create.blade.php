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
               <h4 class="mb-sm-0 font-size-18">Add Bank Account</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Add Bank Account</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <div class="row">
         <div class="col-12">
            <div class="card border border-info">
                <div class="card-header bg-transparent border-danger">
                    <h5 class="my-0 text-info"><i class="bx bx-info-circle me-3"></i>Acoount informatin </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Please enter correct account information. and create withdrawal. otherwise {{env('APP_NAME')}} not responsibility in further wrong transaction </p>
                </div>
            </div>
         </div>
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="row mb-4">
                     <div class="col-md-8">
                        <h4 class="card-title">Add Bank Account</h4>
                     </div>
                  </div>
                  <form action="{{ route('bank.store') }}" method="POST" class="needs-validation" novalidate>
                     @csrf
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Bank Name</label>
                              <div class="input-group" id="contact_name">
                                 <input type="text" class="form-control {{ $errors->has('bank_name') ? 'is-invalid' : '' }}" placeholder="Enter Bank name" name="bank_name" value="{{ old('bank_name') }}">
                                 <span class="input-group-text"><i class="bx bxs-bank"></i></span>
                              </div>
                              @error('bank_name')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Account holder</label>
                              <div class="input-group" id="name">
                                 <input type="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter account holder name" name="name" value="{{ old('name') }}">
                                 <span class="input-group-text"><i class="bx bx-voicemail"></i></span>
                              </div>
                              @error('name')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Mobile</label>
                              <div class="input-group" id="contact_name">
                                 <input type="text" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" placeholder="Enter phone number" name="mobile" value="{{ old('mobile') }}">
                                 <span class="input-group-text"><i class="bx bx-phone"></i></span>
                              </div>
                              @error('mobile')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Account number</label>
                              <div class="input-group" id="account_number">
                                 <input type="text" class="form-control {{ $errors->has('account_number') ? 'is-invalid' : '' }}" placeholder="Enter account number" name="account_number" value="{{ old('account_number') }}">
                                 <span class="input-group-text"><i class="bx bx-code"></i></span>
                              </div>
                              @error('account_number')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>IFSC Code</label>
                              <div class="input-group" id="ifsc">
                                 <input type="text" class="form-control {{ $errors->has('ifsc') ? 'is-invalid' : '' }}" placeholder="Enter ifsc" name="ifsc" value="{{ old('ifsc') }}">
                                 <span class="input-group-text"><i class="bx bxs-bank"></i></span>
                              </div>
                              @error('ifsc')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Account Address</label>
                              <div class="input-group" id="account_address">
                                 <input type="text" class="form-control {{ $errors->has('account_address') ? 'is-invalid' : '' }}" placeholder="Enter account address" name="account_address" value="{{ old('account_address') }}">
                                 <span class="input-group-text"><i class="bx bxs-bank"></i></span>
                              </div>
                              @error('account_address')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Beneficiary ID <small>(Optinal)</small></label>
                              <div class="input-group auth-pass-inputgroup">
                                  <input type="password" class="form-control {{ $errors->has('bank_beneficiary') ? ' is-invalid' : '' }}" placeholder="Enter Beneficiary" aria-label="Password" aria-describedby="password-addon" name="bank_beneficiary">
                                  <button class="btn btn-light " type="button"  id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                              </div>                      
                              @error('bank_beneficiary')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div>
                        <button class="btn btn-primary" type="submit">Save</button>
                     </div>
                  </form>
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