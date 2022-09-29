@extends('front-end.layouts.app')
@section('title','Login')
@section('content')
<div class="address-section mb-60">
   <div class="container">
      <div class="row d-flex justify-content-center">
         <div class="col-md-6">
            <div class="section-title primary4 mt-10">
               <h3>Sign In</h3>
               <p class="para">Sign in to your account to continue.</p>
            </div>
         </div>
      </div>
      <div class="row d-flex justify-content-center">
         <div class="col-lg-8">
            @include('errors.message')
            <form method="POST" action="{{ route('login') }}">
                @csrf
               <div class="row g-4 justify-content-center">
                  <div class="col-lg-8">
                     <div class="form-inner">
                        <input type="text"  placeholder="Your Email: *" class="{{ $errors->has('email') ? ' is-invalid' : '' }}"  name="email" value="{{ old('email') }}" required>
                     </div>
                  </div>
                  <div class="col-lg-8">
                     <div class="form-inner">
                        <input type="text" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter password: *" name="password">
                     </div>
                  </div>
                  <div class="col-lg-8 text-center">
                     <input type="submit" class="eg-btn btn--submit" value="Sign In">
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
@endsection