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
               <h4 class="mb-sm-0 font-size-18">Manual Withdraw</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Manual Withdraw</li>
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
                        <h4 class="card-title">Manual Withdraw</h4>
                     </div>
                  </div>
                  <form action="{{route('payout.store')}}" method="POST" class="needs-validation" novalidate>
                     @csrf
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Bank Account</label>
                              <div class="input-group" id="contact_name">
                                 <select class="form-control {{ $errors->has('bank') ? 'is-invalid' : '' }}" name="bank" value="{{old('bank')}}">
                              		<option value="">Select Bank</option>
                              		@foreach($bank as $key => $data)
                              		<option value="{{$data->id}}">{{$data->bank_name}}</option>
                              		@endforeach
                              	</select>
                                 <span class="input-group-text"><i class="bx bxs-bank"></i></span>
                              </div>
                              @error('bank')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Amount</label>
                              <div class="input-group" id="text">
                                 <input type="text" class="form-control amount {{ $errors->has('amount') ? 'is-invalid' : '' }}" placeholder="Enter amount" name="amount" value="{{ old('amount') }}">
                                 <span class="input-group-text"><i class="bx bx-money"></i></span>
                              </div>
                              @error('amount')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Total Transfer Amount <small>TDS Charge(5%) And Admin Charge(10%)</small></label>
                              <div class="input-group" id="text">
                                 <input type="text" class="form-control tamount" placeholder="Total Transfer Amount" readonly>
                                 <span class="input-group-text"><i class="bx bx-money"></i></span>
                              </div>
                              @error('bank')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="mt-3">
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
<script type="text/javascript">
   $(document).on('keyup','.amount',function(){
      _this = $(this);

      var calculate = _this.val() / 100 * 15;
      var total = _this.val() - calculate;
      $('.tamount').val(total);
   })
</script>
@endsection