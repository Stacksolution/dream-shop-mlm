<header class="header-area style-1 style-3">
   <div class="header-logo">
      <a href=""><img alt="image" src="{{ static_asset('front-end/images/icons/logo.png') }}" style="width:80%;"></a>
   </div>
   <div class="main-nav">
      <div class="mobile-logo-area d-lg-none d-flex justify-content-between align-items-center">
         <div class="mobile-logo-wrap ">
            <a href=""><img alt="image" src="{{ static_asset('front-end/images/icons/logo.png') }}" style="width:80%;"></a>
         </div>
         <div class="menu-close-btn">
            <i class="bi bi-x-lg text-white"></i>
         </div>
      </div>
      <ul class="menu-list">
         <li class="menu-item-has-children">
            <a href="{{URL('/')}}">Home</a>
         </li>
         <li><a href="contact.html">Abount us</a></li>
         <li><a href="contact.html">Contact us</a></li>
         @auth
         <li><a href="{{route('back.office')}}">My Account</a></li>
         @else
         <li class="menu-item-has-children">
            <a href="#" class="drop-down">My Account</a><i class='bi bi-chevron-down dropdown-icon'></i>
            <ul class="sub-menu">
               <li><a href="{{route('login')}}">Sign In</a></li>
               <li><a href="{{route('user.signup')}}">Sign Up</a></li>
            </ul>
         </li>
         @endauth
      </ul>
   </div>
   <div class="nav-right style-2 d-flex align-items-center gap-5">
      <div class="mobile-menu-btn d-lg-none d-block">
         <h5 class="text-dark mb-0"><i class="bi bi-list text-dark"></i></h5>
      </div>
      <div class="hotline d-xxl-flex d-none">
         <div class="hotline-icon">
            <svg width="34" height="34" viewBox="0 0 34 34" xmlns="http://www.w3.org/2000/svg">
               <g clip-path="url(#clip0_1225_6)">
                  <path d="M2.88867 3.31366C1.52734 3.7121 0.451563 4.8078 0.0996094 6.15585C0.0199219 6.45468 0 6.97265 0 8.53319L0.00664063 10.5254L7.37109 16.0039C11.4352 19.0254 14.948 21.5887 15.2004 21.7215C16.3027 22.2926 17.684 22.2926 18.7996 21.7215C19.0719 21.582 22.359 19.1781 26.6289 16.0039L33.9934 10.5254L34 8.53983C34 6.3285 33.9734 6.10936 33.5551 5.28593C33.2363 4.64843 32.5391 3.95116 31.9016 3.63241C30.9453 3.15429 32.134 3.18749 16.9602 3.19413C4.13711 3.19413 3.26055 3.20741 2.88867 3.31366ZM30.5801 6.0164C31.1977 6.34843 31.2973 6.61405 31.3305 7.96874L31.357 9.06444L24.4773 14.1777C19.291 18.0359 17.5312 19.3109 17.3055 19.3773C17.0531 19.4504 16.9469 19.4504 16.7012 19.3773C16.4754 19.3109 14.6891 18.0226 9.52266 14.1777L2.64297 9.06444L2.66953 7.96874C2.68945 7.07226 2.71602 6.83319 2.81563 6.64061C3.04141 6.20897 3.31367 6.00311 3.78516 5.90351C3.91133 5.87694 9.93437 5.86366 17.166 5.8703L30.3145 5.87694L30.5801 6.0164Z" />
                  <path d="M0.000124167 20.5926C0.000124167 28.1894 -0.0197977 27.7844 0.445046 28.7141C0.757155 29.3316 1.45442 30.0355 2.09192 30.3609C3.03489 30.8457 1.85286 30.8125 17.0001 30.8125C32.1275 30.8125 30.9454 30.8457 31.9017 30.3676C32.5392 30.0488 33.2365 29.3516 33.5552 28.7141C34.0267 27.7844 34.0001 28.1961 33.9868 20.5926L33.9669 13.7461L32.672 14.7023L31.3771 15.6652L31.3439 21.3961C31.3107 26.8348 31.304 27.1402 31.1845 27.3594C31.0118 27.6848 30.8857 27.8176 30.5802 27.9836L30.3146 28.123H17.0001H3.68567L3.42005 27.9836C3.11458 27.8176 2.98841 27.6848 2.81575 27.3594C2.69622 27.1402 2.68958 26.848 2.66966 21.4027L2.64973 15.6785L1.41458 14.7621C0.730593 14.2574 0.139577 13.8191 0.0864523 13.7926C0.0134054 13.7461 0.000124167 14.9082 0.000124167 20.5926Z" />
               </g>
               <defs>
                  <clipPath id="clip0_1225_6">
                     <rect width="34" height="34" />
                  </clipPath>
               </defs>
            </svg>
         </div>
         <div class="hotline-info">
            <span>Messge Us</span>
            <h6><a href=""><span class="__cf_email__">info@mydreamshop.in</span></a></h6>
         </div>
      </div>
   </div>
</header>
