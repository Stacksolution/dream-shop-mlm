<!doctype html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Stack') }}</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
      <link rel="shortcut icon" href="{{ static_asset('back-end/images/favicon.ico')}}">
      <link href="{{ static_asset('back-end/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <link href="{{ static_asset('back-end/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{ static_asset('back-end/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
   </head>
   <body>
      <div class="account-pages my-5 pt-sm-5">
         @yield('content')
      </div>
      <script src="{{ static_asset('back-end/libs/jquery/jquery.min.js')}}"></script>
      <script src="{{ static_asset('back-end/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      @yield('script')
      <script src="{{ static_asset('back-end/libs/metismenu/metisMenu.min.js')}}"></script>
      <script src="{{ static_asset('back-end/libs/simplebar/simplebar.min.js')}}"></script>
      <script src="{{ static_asset('back-end/libs/node-waves/waves.min.js')}}"></script>
      <script src="{{ static_asset('back-end/js/app.js')}}"></script>
   </body>
</html>
