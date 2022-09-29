@extends('back-end.layouts.app')
@section('header')
  <meta property="og:title" content="Join with {{env('APP_NAME')}} and making online income with {{env('APP_NAME')}} !" />
  <meta property="og:url" content="{{route('user.signup','source_id='.Auth()->user()->user_referral)}}" />
  <meta property="og:image" content="" />
  <meta property="og:description" content="
                Join with {{Auth()->user()->name}} and making online income with {{env('APP_NAME')}} ! 

                Just active profile ₹ 200 and get upto ₹ 100 cashback And every user registration get up to ₹ 10 commission. Use this link: {{route('user.signup','source_id='.Auth()->user()->user_referral)}}" />
  <meta property="og:site_name" content="{{env('APP_NAME')}}" />
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-12">
             <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Invite</h4>
                <div class="page-title-right">
                   <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                      <li class="breadcrumb-item active">Invite</li>
                   </ol>
                </div>
             </div>
          </div>
       </div>
       <!-- end page title -->
       <div class="row">
          <div class="col-xl-12">
            <div class="modal-body">
                 <div class="text-center mb-4">
                     <div class="avatar-md mx-auto mb-4">
                         <div class="avatar-title bg-light rounded-circle text-primary h1">
                             <i class="mdi mdi-email-open"></i>
                         </div>
                     </div>
                     <div class="row justify-content-center">
                         <div class="col-xl-10">
                             <h4 class="text-primary">Refer and Earn !</h4>
                              <!-- <p class="text-muted font-size-14 mb-4">Earn upto ₹ 10,000 by referring your friends to join {{env('APP_NAME')}}. You will receive Rs 40 for every successful referral. Your friend will also receive a surprise but guaranteed cashback reward on making his/her activet your profile on {{env('APP_NAME')}} </p>
 -->                              <span class="message"></span>
                             <div class="input-group bg-light rounded">
                                 <input type="text" id="copyText1" class="form-control bg-transparent border-0" value="{{route('user.signup','source_id='.Auth()->user()->user_referral)}}" readonly>
                                 <button class="btn btn-primary" onclick="withJquery(); " type="button" id="button-addon2">
                                     <i class="bx bxs-copy"></i>
                                 </button>
                             </div>
                         </div>
                         <div class="col-xl-10 mt-3">
                            <!-- ShareThis BEGIN -->
                            <!-- <div class="sharethis-inline-share-buttons"></div> --><!-- ShareThis END -->
                         </div>
                     </div>
                 </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection

@section('script')
<script src="{{ static_asset('back-end/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ static_asset('back-end/libs/node-waves/waves.min.js')}}"></script>
<script src="{{ static_asset('back-end/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{ static_asset('back-end/js/pages/dashboard.init.js')}}"></script>
<script type="text/javascript">
function withJquery(){
   var temp = $("<input>");
   $("body").append(temp);
   temp.val($('#copyText1').val()).select();
   document.execCommand("copy");
   temp.remove();

   $('.message').html('<div class="alert alert-success" role="alert">successfully copied ! </div>');
}
</script>
@endsection