<header id="page-topbar">
   <div class="navbar-header">
      <div class="d-flex">
         <div class="navbar-brand-box">
            <a href="" class="logo logo-dark">
            <span class="logo-sm">
            <img src="{{ static_asset('front-end/img/logo-white.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
            <img src="{{ static_asset('front-end/img/logo-white.png')}}" alt="" height="17">
            </span>
            </a>
            <a href="" class="logo logo-light">
            <span class="logo-sm">
            <img src="{{ static_asset('front-end/img/logo-white.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
            <img src="{{ static_asset('front-end/img/logo-white.png')}}" alt="" height="19">
            </span>
            </a>
         </div>
         <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
         <i class="fa fa-fw fa-bars"></i>
         </button>
         @if(Auth()->user()->user_id_status == '1')
         <button type="button" class="btn-block btn-sm btn btn-outline-success  waves-effect waves-light mt-4" style="height: 20%;margin-left: 10px;"><i class="bx bx-smile font-size-16 align-middle me-2 d-none d-xl-inline-block"></i>Activated
        </button>
        @else
        <button type="button" class="btn-block btn btn-sm btn-outline-danger  waves-effect waves-light mt-4" style="height: 20%;margin-left:10px;"><i class="bx bx-block font-size-16 align-middle me-2 d-none d-xl-inline-block"></i>Pending
        </button>
        @endif
        <button type="button" class="btn-block btn btn-sm btn-outline-danger waves-effect waves-light mt-4" style="height: 20%;margin-left: 10px;" onclick="location.replace('{{ route('clear') }}')"><i class="bx bx-rotate-left"></i>
        </button>
      </div>
         <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle header-profile-user" src="{{ static_asset('back-end/images/users/image.png')}}" alt="Header Avatar">
            <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{Auth()->user()->name}}</span>
            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
               <a class="dropdown-item" href="{{route('profile')}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
               <a class="dropdown-item" href="{{route('document.create')}}"><i class="bx bx-file font-size-16 align-middle me-1"></i> Document (KYC)</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item text-danger" href="{{route('user.logout')}}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
            </div>
         </div>
      </div>
   </div>
</header>