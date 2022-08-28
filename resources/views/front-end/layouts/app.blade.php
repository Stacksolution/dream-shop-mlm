<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
      <link rel="icon" href="assets/img/favicon.png" type="image/png" sizes="16x16">
      <title>@yield('title')</title>
      <link rel="stylesheet" href="{{ static_asset('front-end/css/main.css') }}">
   </head>
   <body>
      <div id="preloader">
         <div class="loader1">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
         </div>
      </div>
      <!--preloader end-->
      <!--header section start-->
      @include('front-end.include.header-file')
      <!--header section end-->
      <div class="main">
          @yield('content')
      </div>
      <!--footer section start-->
      @include('front-end.include.footer-file')
      <!--scroll bottom to top button start-->
      <button class="scroll-top scroll-to-target" data-target="html">
      <span class="fas fa-hand-point-up"></span>
      </button>
      <!--scroll bottom to top button end-->
      <!--build:js-->
      <script src="{{ static_asset('front-end/js/vendors/jquery-3.5.1.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/popper.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/bootstrap.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/jquery.magnific-popup.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/jquery.easing.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/mixitup.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/headroom.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/smooth-scroll.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/wow.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/owl.carousel.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/jquery.waypoints.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/jquery.countdown.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/vendors/validator.min.js')}}"></script>
      <script src="{{ static_asset('front-end/js/app.js')}}"></script>
   </body>
</html>