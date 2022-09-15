@extends('back-end.layouts.app')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Wallets</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Wallets Recharge</li>
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
                        <h4 class="card-title">Wallets Recharge</h4>
                     </div>
                  </div>
                  <form action="{{ route('recharge.cashfree') }}" method="POST" class="needs-validation" novalidate>
                     @csrf
                     <div class="col-md-12">
                        <div class="card bg-dark text-light mt-4">
                           <div class="card-body">
                              <div class="text-center">
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <div>
                                          <h5 class="font-size-15 text-light">User</h5>
                                          <p class="text-light mb-2 text-truncate">{{Auth()->user()->name}}</p>
                                       </div>
                                    </div>
                                    <div class="col-sm-4">
                                       <div>
                                          <h5 class="font-size-15 text-light">ID</h5>
                                          <p class="text-light mb-2 text-truncate">{{Auth()->user()->user_referral}}</p>
                                       </div>
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="mt-4 mt-sm-0">
                                          <h5 class="font-size-15 text-light">Amount</h5>
                                          <p class="text-light mb-2">{{$balance}}</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Amount</label>
                              <div class="input-group" id="amount">
                                 <input type="text" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" placeholder="Enter amount" name="amount" value="{{ old('amount') }}" onkeyup="this.value = this.value.replace(/[^0-9]/g, '')">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('amount')
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