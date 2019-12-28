   <!-- Topbar Start -->
   <div class="navbar-custom">
       <ul class="list-unstyled topnav-menu float-right mb-0">

           <li class="dropdown notification-list">
               <a class="nav-link nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                   <img src="{{ URL::asset('assets/images/users/user.jpg') }}" alt="user-image" class="rounded-circle">
               </a>
           </li>

           <li class="dropdown notification-list">
               <a href="/logout" class="nav-link right-bar-toggle waves-effect waves-light">
                   <span>{{ __('backend.logout') }}</span>
               </a>
           </li>
       </ul>



       <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
           <li>
               <button class="button-menu-mobile waves-effect waves-light">
                   <i class="fe-menu"></i>
               </button>
           </li>
       </ul>

       <!-- LOGO -->
       <div class="logo-box">
           <a href="/" class="logo text-center">
               <span class="logo-lg">
{{--                   <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="20">--}}
                   {{--                   <span class="logo-lg-text-light">{{ env('APP_NAME') }}</span>--}}
               </span>
               <span class="logo-sm">
                   <span class="logo-sm-text-dark"></span>
{{--                                      <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="24">--}}
               </span>
           </a>
       </div>
   </div>
   <!-- end Topbar -->
