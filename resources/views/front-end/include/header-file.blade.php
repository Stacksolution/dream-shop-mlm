   <header class="header position-relative z-9">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-dark navbar-theme-primary fixed-top headroom">
         <div class="container position-relative">
            <a class="navbar-brand mr-lg-3" href="">
            <img class="navbar-brand-dark" src="{{ static_asset('front-end/img/logo-white.png')}}" alt="menuimage" style="width: 50%;">
            <img class="navbar-brand-light" src="{{ static_asset('front-end/img/logo-white.png')}}" alt="menuimage" style="width: 50%;">
            </a>
            <div class="navbar-collapse collapse" id="navbar-default-primary">
               <div class="navbar-collapse-header">
                  <div class="row">
                     <div class="col-6 collapse-brand">
                        <a href="#">
                        <img src="{{ static_asset('front-end/img/logo-white.png') }}" alt="menuimage">
                        </a>
                     </div>
                     <div class="col-6 collapse-close">
                        <i class="fas fa-times" data-toggle="collapse" role="button"
                           data-target="#navbar-default-primary" aria-controls="navbar-default-primary"
                           aria-expanded="false" aria-label="Toggle navigation"></i>
                     </div>
                  </div>
               </div>
               <ul class="navbar-nav navbar-nav-hover ml-auto">
                  <li class="nav-item">
                     <a href="{{ URL('/')}}" class="nav-link">
                     <span class="nav-link-inner-text">Home</span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="">About Us</a>
                  </li>
                  <li class="nav-item"><a class="nav-link" href="">Contact Us</a></li>
                  @auth
                  <li class="nav-item"><a class="nav-link" href="{{route('back.office')}}">My Account</a></li>
                  @else
                  <li class="nav-item"><a class="nav-link" href="{{route('user.login')}}">Login</a></li>
                  @endauth
               </ul>
            </div>
            <div class="d-flex align-items-center">
               <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbar-default-primary" aria-controls="navbar-default-primary" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
            </div>
         </div>
      </nav>
   </header>