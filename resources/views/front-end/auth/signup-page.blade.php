@extends('front-end.layouts.app')
@section('title',$metadata['meta_title'])
@section('description',$metadata['meta_description'])
@section('content')
<div class="address-section mb-60">
   <div class="container">
      <div class="row d-flex justify-content-center">
         <div class="col-md-6">
            <div class="section-title primary4 mt-10">
               <h3>Sign Up</h3>
               <p class="text-muted">Sign up to your account to continue.</p>
            </div>
         </div>
      </div>
      <div class="row d-flex justify-content-center">
         <div class="col-lg-8">
            @include('errors.message')
            <form method="POST" action="{{ route('register') }}">
               @csrf
               <div class="row g-4 justify-content-center">
                  <div class="col-lg-6">
                     <div class="form-inner">
                        <input type="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter your name" name="name" value="{{ old('name') }}" required>
                     </div>
                     @error('name')
                     <span class="text-danger" role="alert">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="col-lg-6">
                     <div class="form-inner">
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="name@address.com" name="email" value="{{ old('email') }}" required>
                     </div>
                     @error('email')
                     <span class="text-danger" role="alert">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="col-lg-6">
                     <div class="form-inner">
                        <input type="text" class="form-control {{ $errors->has('mobile') ? ' is-invalid' : '' }}" placeholder="+91-789777XXXX" name="mobile" value="{{ old('mobile') }}" required>
                     </div>
                     @error('mobile')
                     <span class="text-danger" role="alert">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="col-lg-6">
                     <div class="form-inner">
                        <input type="text" class="form-control {{ $errors->has('member_id') ? ' is-invalid' : '' }}" placeholder="Enter your member id" name="member_id" value="{{ $source_id }}" readonly> 
                     </div>
                     @error('member_id')
                     <span class="text-danger" role="alert">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="col-lg-12">
                     <div class="form-inner">
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter your password" name="password">
                     </div>
                     @error('password')
                     <span class="text-danger" role="alert">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="col-lg-8 text-center">
                     <input type="submit" class="eg-btn btn--submit" value="Sign Up">
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