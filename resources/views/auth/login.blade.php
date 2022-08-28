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
                         <h5 class="text-primary">Welcome Back !</h5>
                         <p>Sign in to continue to Skote.</p>
                      </div>
                   </div>
                   <div class="col-5 align-self-end">
                      <img src="{{ static_asset('back-end/images/profile-img.png')}}" alt="" class="img-fluid">
                   </div>
                </div>
             </div>
             <div class="card-body pt-0">
                <div class="auth-logo">
                   <a href="index.html" class="auth-logo-light">
                      <div class="avatar-md profile-user-wid mb-4">
                         <span class="avatar-title rounded-circle bg-light">
                         <img src="{{ static_asset('back-end/images/logo-light.svg')}}" alt="" class="rounded-circle" height="34">
                         </span>
                      </div>
                   </a>
                   <a href="index.html" class="auth-logo-dark">
                      <div class="avatar-md profile-user-wid mb-4">
                         <span class="avatar-title rounded-circle bg-light">
                         <img src="{{ static_asset('back-end/images/logo.svg')}}" alt="" class="rounded-circle" height="34">
                         </span>
                      </div>
                   </a>
                </div>
                <div class="p-2">
                  @include('errors.message')
                  <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                   @csrf
                      <div class="mb-3">
                         <label for="username" class="form-label">Username</label>
                         <input type="email" id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter email">
                      </div>
                      <div class="mb-3">
                         <label class="form-label">Password</label>
                         <div class="input-group auth-pass-inputgroup">
                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" name="password">
                            <button class="btn btn-light " type="button"  id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                         </div>
                      </div>
                      <div class="form-check">
                         <input class="form-check-input" type="checkbox" id="remember-check" {{ old('remember') ? 'checked' : '' }}>
                         <label class="form-check-label" for="remember-check">
                         Remember me
                         </label>
                      </div>
                      <div class="mt-3 d-grid">
                         <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                      </div>
                      <div class="mt-4 text-center">
                         <a href="{{route('password.request')}}" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
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
