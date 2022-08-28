<div class="vertical-menu">
   <div data-simplebar class="h-100">
      <!--- Sidemenu -->
      <div id="sidebar-menu">
         <!-- Left Menu Start -->
         <ul class="metismenu list-unstyled" id="side-menu">
            <li>
               <a href="{{route('back.office')}}" class="waves-effect">
               <i class="bx bx-home-circle"></i>
               <span key="t-dashboards">Dashboard</span>
               </a>
            </li>
            <li class="menu-title" key="t-apps">Apps</li>
            <li>
               <a href="javascript: void(0);" class="waves-effect">
               <i class="bx bx-user"></i>
               <span key="t-member">Team Management</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('customer.index')}}" key="t-member">Pool Team</a></li>
                  <li><a href="{{route('level.index')}}" key="t-level">Level Team</a></li>
                  <li><a href="{{route('binary.index')}}" key="t-level">Binary Team</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="waves-effect">
               <i class="bx bx-package"></i>
               <span key="Packages">Products & Packages</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('product.index')}}" key="Packages">All Products</a></li>
               </ul>
            </li>
            @if(Auth()->user()->user_type != 'admin')
            <li>
               <a href="javascript: void(0);" class="waves-effect">
               <i class="bx bx-wallet"></i>
               <span key="wallets">Wallets</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('wallets.show',[Auth()->user()->id])}}" key="wallets">Wallets history</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="waves-effect">
               <i class="bx bxs-bank"></i>
               <span key="bank">Bank Account</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('bank.show',[Auth()->user()->id])}}" key="bank">Bank Account</a></li>
                  <li><a href="{{route('payout.index')}}" key="wallets">Manual Withdraw</a></li>
               </ul>
            </li>
            <!-- <li>
               <a href="javascript: void(0);" class="waves-effect">
               <i class="bx bx-support"></i>
               <span key="support">Help & Support</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="d" key="support">Help & Support</a></li>
               </ul>
            </li> -->
            @endif
            <li>
               <a href="{{route('invite.index')}}" class="waves-effect">
               <i class="fa fa-share-alt" aria-hidden="true"></i>
               <span key="support">Refer & Earn</span>
               </a>
            </li>
            @if(Auth()->user()->user_type == 'admin')
            <li>
               <a href="javascript: void(0);" class="waves-effect">
               <i class="bx bxs-bank"></i>
               <span key="bank">Bank Account</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('bank.index')}}" key="bank">Bank Account</a></li>
                  <li><a href="{{route('payout.index')}}" key="wallets">Manual Withdraw</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="waves-effect">
               <i class="bx bx-cog"></i>
               <span key="support">Setting & configuration</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('setting.index')}}" key="support">Website Setting</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="waves-effect">
               <i class="bx bx-file"></i>
               <span key="support">Documents & Kyc</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('document.index')}}" key="support">Documents</a></li>
               </ul>
            </li>
            @endif
         </ul>
      </div>
   </div>
</div>