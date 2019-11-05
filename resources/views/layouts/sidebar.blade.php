 <div class="left-side-menu">
       <div class="slimscroll-menu">
           <div id="sidebar-menu">
               <ul class="metismenu" id="side-menu">
                   <li class="menu-title">{{ __('backend.navigation') }}</li>
                   @foreach (config('sidebar') as $main)
{{--                   @hasanyrole( $main['roles'] )--}}
                   <li>
                       <a href="{{ route($main['route']) }}" class="waves-effect">
                           <i class="{{ $main['icon'] }}"></i>
                           @if (!empty($main['badge']))
                           <span class="badge badge-info float-right">{{ $main['badge'] }}</span>
                           @endif
                           <span>{{ __($main['slug']) }}</span>
                       </a>
{{--                       <ul class="nav-second-level" aria-expanded="false">--}}
{{--                           @foreach ($main['items'] as $item)--}}
{{--                           <li>--}}
{{--                               @if (!empty($item['route']))--}}
{{--                                   <a href="{{ route($item['route']) }}">{{ __($item['slug']) }}</a>--}}
{{--                               @else--}}
{{--                                   <a href="{{ ($item['href']) }}">{{ __($item['slug']) }}</a>--}}
{{--                               @endif--}}
{{--                           </li>--}}
{{--                           @endforeach--}}
{{--                       </ul>--}}
                   </li>
{{--                   @endhasanyrole--}}
                   @endforeach
               </ul>
           </div>
           <div class="clearfix"></div>
       </div>
   </div>
