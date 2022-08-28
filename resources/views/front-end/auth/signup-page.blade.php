@extends('front-end.layouts.app')

@section('title',$metadata['meta_title'])
@section('description',$metadata['meta_description'])

@section('content')
<section class="section section-lg section-header position-relative min-vh-100 flex-column d-flex justify-content-center" style="background: url('{{ static_asset("front-end/img/slider-bg-1.svg") }}')no-repeat center bottom / cover">
<div class="container">
   <div class="row align-items-center justify-content-between">
      <div class="col-md-6 col-lg-6">
         <div class="hero-content-left text-white">
            <h1 class="display-2">Create Your Account</h1>
            <p class="lead">
               Keep your face always toward the sunshine - and shadows will fall behind you.
            </p>
         </div>
      </div>
      <div class="col-md-6 col-lg-6">
         <div class="card login-signup-card shadow-lg mb-0">
            <div class="card-body px-md-5 py-5">
               <div class="mb-5">
                  <h3>Create Account</h3>
                  <p class="text-muted">Sign in to your account to continue.</p>
               </div>
               <!--sign up form-->
               <form class="login-signup-form" method="POST" action="{{ route('register') }}">
                            @csrf
                  <div class="row">
                     <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                           <label class="font-weight-bold">Your Name</label>
                           <div class="input-group input-group-merge">
                              <div class="input-icon">
                                 <i class="ti-user"></i>
                              </div>
                              <input type="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter your name" name="name" value="{{ old('name') }}" required>
                           </div>
                           @error('name')
                           <span class="text-danger" role="alert">{{ $message }}</span>
                          @enderror
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                           <label class="font-weight-bold">Email Address</label>
                           <div class="input-group input-group-merge">
                              <div class="input-icon">
                                 <i class="ti-email"></i>
                              </div>
                              <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="name@address.com" name="email" value="{{ old('email') }}" required>
                           </div>
                           @error('email')
                           <span class="text-danger" role="alert">{{ $message }}</span>
                          @enderror
                        </div>
                     </div>
                  </div>
                    <div class="form-group">
                       <label class="font-weight-bold">
                       Mobile
                       </label>
                       <div class="input-group input-group-merge">
                          <div class="input-icon">
                             <i class="ti-mobile"></i>
                          </div>
                          <input type="text" class="form-control {{ $errors->has('mobile') ? ' is-invalid' : '' }}" placeholder="+91-789777XXXX" name="mobile" value="{{ old('mobile') }}" required>
                       </div>
                       @error('mobile')
                        <span class="text-danger" role="alert">{{ $message }}</span>
                       @enderror
                    </div>
                  <div class="form-group">
                     <label class="font-weight-bold">Sponser ID</label>
                     <div class="input-group input-group-merge">
                        <div class="input-icon">
                           <i class="ti-lock"></i>
                        </div>
                        <input type="text" class="form-control {{ $errors->has('member_id') ? ' is-invalid' : '' }}" placeholder="Enter your member id" name="member_id" value="{{ $source_id }}" readonly> 
                     </div>
                     @error('member_id')
                        <span class="text-danger" role="alert">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label class="font-weight-bold">Password</label>
                     <div class="input-group input-group-merge">
                        <div class="input-icon">
                           <i class="ti-lock"></i>
                        </div>
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter your password" name="password">
                     </div>
                     @error('password')
                        <span class="text-danger" role="alert">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="my-4">
                     <div class="form-check square-check">
                        <input class="form-check-input" type="checkbox" value="" id="check-terms">
                        <label class="form-check-label" for="check-terms">
                        I agree to the <a href="#">terms and conditions</a>
                        </label>
                     </div>
                  </div>
                  <button class="btn btn-block btn-secondary border-radius mt-4 mb-3">
                  Sign up
                  </button>
               </form>
            </div>
            <div class="card-footer bg-soft text-center border-top px-md-5"><small>Already registered?</small>
               <a href="{{route('user.login')}}" class="small"> Login</a>
            </div>
         </div>
      </div>
   </div>
</div>
</section>
@endsection
@section('script')
@endsection