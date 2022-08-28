@extends('back-end.layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card overflow-hidden">
             <div class="bg-primary bg-soft">
                <div class="row">
                   <div class="col-7">
                      <div class="text-primary p-4">
                         <h5 class="text-primary">Reset Password !</h5>
                         <p>Re-Password with {{ config('app.name', 'Stack') }}.</p>
                      </div>
                   </div>
                   <div class="col-5 align-self-end">
                      <img src="{{ static_asset('back-end/images/profile-img.png')}}" alt="" class="img-fluid">
                   </div>
                </div>
             </div>
             <div class="card-body pt-0">
                <div class="auth-logo">
                   <a href="javascript:;" class="auth-logo-light">
                      <div class="avatar-md profile-user-wid mb-4">
                         <span class="avatar-title rounded-circle bg-light">
                         <img src="{{ static_asset('back-end/images/logo-light.svg')}}" alt="" class="rounded-circle" height="34">
                         </span>
                      </div>
                   </a>
                   <a href="javascript:;" class="auth-logo-dark">
                      <div class="avatar-md profile-user-wid mb-4">
                         <span class="avatar-title rounded-circle bg-light">
                         <img src="{{ static_asset('back-end/images/logo.svg')}}" alt="" class="rounded-circle" height="34">
                         </span>
                      </div>
                   </a>
                </div>
                <div class="p-2">
                  @if (session('status'))
                     <div class="alert alert-success" role="alert">
                         {{ session('status') }}
                     </div>
                  @endif
                  <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                      <div class="mb-3">
                         <label for="username" class="form-label">Username</label>
                         <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">
                         @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                         @enderror
                      </div>
                      <div class="mt-3 d-grid">
                         <button class="btn btn-primary waves-effect waves-light" type="submit">{{ __('Send Password Reset Link') }}</button>
                      </div>
                      <div class="mt-4 text-center">
                         <a href="{{route('login')}}" class="text-muted"><i class="bx bx-arrow-back"></i> Login ?</a>
                      </div>
                   </form>
                </div>
             </div>
          </div>
          <div class="mt-5 text-center">
             <div>
                <p>
                   © <script>
                      document.write(new Date().getFullYear())
                   </script> {{ config('app.name', 'Stack') }} <i class="mdi mdi-heart text-danger"></i> Design & Develop by Stack Solution
                </p>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
