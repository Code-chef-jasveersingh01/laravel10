<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                {{-- Admin panel --}}
                <img src="{{ URL::asset('assets/images/svgviewer-output.svg') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                {{-- Admin panel --}}
                <img src="{{ URL::asset('assets/images/svgviewer-output.svg') }}" alt="" height="50px" width="200px">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                {{-- Admin panel --}}
                <img src="{{ URL::asset('assets/images/svgviewer-output.svg') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                {{-- Admin panel --}}
                <img src="{{ URL::asset('assets/images/filogo.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->is('dashboard*')) ? 'menu-link active' : 'menu-link' }}" href="{{route('admin.dashboard')}}">
                        <i class="ri-dashboard-2-line"></i> <span>@lang('main.dashboard')</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                @if (Auth::user())
                    {{-- @canany(['View All Admin', 'View All Designer', 'View All Users','View All Roles']) --}}
                        <li class="nav-item d-none">
                            <a class="nav-link menu-link {{ (request()->is('users*')) ? 'active collaspe' : 'collapsed' }}" href="#users"  data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->is('users*')) ? 'true' : 'false' }}" aria-controls="users">
                                <i class="ri-account-circle-line"></i> <span>@lang('main.users')</span>
                            </a>
                            <div class="menu-dropdown {{ (request()->is('users*')) ? 'collapse show' : 'collapse' }}" id="users">
                                <ul class="nav nav-sm flex-column">
                                </ul>
                            </div>
                        </li> <!-- end Users Menu -->
                    {{-- @endcanany --}}
                @endif

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('users*')) ? 'active collaspe' : 'collapsed' }}" href="#users"  data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->is('users*')) ? 'true' : 'false' }}" aria-controls="users">
                        <i class="ri-account-circle-line"></i> <span>@lang('main.users')</span>
                    </a>
                    <div class="menu-dropdown {{ (request()->is('users*')) ? 'collapse show' : 'collapse' }}" id="users">
                        <ul class="nav nav-sm flex-column">
                            {{-- @can('View All Admin') --}}
                                {{-- <li class="nav-item">
                                    <a href="{{route('admin.adminList')}}" class="nav-link {{ (request()->is('users/admin*')) ? 'active' : '' }}">@lang('main.admin')</a>
                                </li> --}}
                            {{-- @endcan --}}
                            {{-- @can('View All Users') --}}
                                <li class="nav-item">
                                    <a href="{{route('admin.usersList')}}" class="nav-link {{ (request()->is('users/user*')) ? 'active' : '' }}">@lang('main.users')</a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can('View All Roles') --}}
                                {{-- <li class="nav-item">
                                    <a href="{{route('admin.roleList')}}" class="nav-link {{ (request()->is('users/role*')) ? 'active' : '' }}">@lang('main.roles')</a>
                                </li> --}}
                            {{-- @endcan --}}
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="#settings" class="nav-link menu-link {{ (request()->is('settings*')) ? 'active collaspe' : 'collapsed' }}" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->is('settings*')) ? 'true' : 'false' }}" aria-controls="settings" data-key="t-email">
                        <i class="ri-stack-line"></i> <span>@lang('main.setting')</span>
                    </a>
                    <div class="menu-dropdown {{ (request()->is('settings*')) ? 'collapse show' : 'collapse' }}" id="settings">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="" class="nav-link {{ (request()->is('settings/nvr*')) ? 'active' : '' }}">@lang('main.nvr_configuration')</a>
                            </li>
                        </ul>
                    </div>
                </li> <!--- setting -->
                <!-- end store Menu -->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
