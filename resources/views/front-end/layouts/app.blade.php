<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="@yield('description')">
      <meta property="og:type" content= "website"/>
      <meta property="og:url" content="{{ URL('/') }}"/>
      <meta property="og:site_name" content="Stack Overlode" />
      <meta property="og:title" content="@yield('title')"/>
      <meta property="og:description" content="@yield('description')" />
      <meta property="og:image" itemprop="image primaryImage" content="https://stackoverlode.com/front-end/images/ogimage.png" />
      <meta name="twitter:card" content="summary_large_image"/>
      <meta name="twitter:site" content="Stack Overlode"/>
      <meta name="twitter:title" content="@yield('title')">
      <meta name="twitter:description" content="@yield('description')"/>
      <meta name="twitter:image" content="https://stackoverlode.com/front-end/images/ogimage.png"/>
      <link rel="icon" href="{{ static_asset('front-end/img/favicon.png') }}" type="image/png" sizes="16x16">
      <title>@yield('title')</title>
      <link rel="stylesheet" href="{{ static_asset('front-end/css/animate.css') }}">
      <link rel="stylesheet" href="{{ static_asset('front-end/css/all.css') }}">
      <link rel="stylesheet" href="{{ static_asset('front-end/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ static_asset('front-end/css/boxicons.min.css') }}">
      <link rel="stylesheet" href="{{ static_asset('front-end/css/bootstrap-icons.css') }}">
      <link rel="stylesheet" href="{{ static_asset('front-end/css/jquery-ui.css') }}">
      <link rel="stylesheet" href="{{ static_asset('front-end/css/swiper-bundle.css') }}">
      <link rel="stylesheet" href="{{ static_asset('front-end/css/nice-select.css') }}">
      <link rel="stylesheet" href="{{ static_asset('front-end/css/magnific-popup.css') }}">
      <link rel="stylesheet" href="{{ static_asset('front-end/css/odometer.css') }}">
      <link rel="stylesheet" href="{{ static_asset('front-end/css/style.css') }}">
   </head>
   <body>
      <div class="egns-preloader">
         <div class="container">
            <div class="row d-flex justify-content-center">
               <div class="col-6">
                  <div class="circle-border">
                     <div class="moving-circle"></div>
                     <div class="moving-circle"></div>
                     <div class="moving-circle"></div>
                     <svg width="180px" height="150px" viewBox="0 0 187.3 93.7" preserveAspectRatio="xMidYMid meet" style="left: 50%; top: 50%; position: absolute; transform: translate(-50%, -50%) matrix(1, 0, 0, 1, 0, 0);">
                        <path stroke="#D90A2C" id="outline" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" />
                        <path id="outline-bg" opacity="0.05" fill="none" stroke="#959595" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" />
                     </svg>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--preloader end-->
      <!--header section start-->
      @include('front-end.include.header-file')
      <!--header section end-->
      @yield('content')
      <!--footer section start-->
      @include('front-end.include.footer-file')
      <script src="{{ static_asset('front-end/js/jquery-3.6.0.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/jquery-ui.js')}}"></script>
      <script src="{{ static_asset('front-end/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/wow.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/swiper-bundle.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/jquery.nice-select.js')}}"></script>
      <script src="{{ static_asset('front-end/js/odometer.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/viewport.jquery.js')}}"></script>
      <script src="{{ static_asset('front-end/js/jquery.magnific-popup.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/main.js')}}"></script>
   </body>
</html>