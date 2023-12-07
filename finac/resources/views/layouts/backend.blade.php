<!DOCTYPE html>
<html lang="fr">

<title>FINAC - Dashboard</title>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta')
<link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/components.css')}}">


<!-- Custom style CSS -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
<link rel="icon" type="image/x-icon" href="{{asset('asset/images/logo_finac.jpg')}}">


</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <span class="d-sm-none d-lg-inline-block text-dark">Menu</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            @if($activeLink === 'armory')
                                <a href="{{route('armory.update_details')}}" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                                </a>
                            @endif
                            <a href="{{ route('logout_dashboard') }}" class="nav-link nav-link-lg--}}
                     text-danger"
                               onclick="document.getElementById('mylogoutid').submit();"> <i
                                    class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href=""><span class="green">FI</span><span class="red">N</span><span class="yellow">AC</span></a>
                    </div>
                    <ul class="sidebar-menu">

                        @if($activeLink === 'user')
                            <li class="dropdown {{$subactiveLink === 'user.armory' ? 'active' : ''}}">
                                <a href="{{route('add_armory')}}" class="nav-link"><i data-feather="plus-circle"></i><span>Creer une armurerie</span></a>
                            </li>
                            <li class="dropdown {{$subactiveLink === 'user.declaration.perte' ? 'active' : ''}}">
                                <a href="{{ route('declaration.LossDeclaration') }}" class="nav-link"><i data-feather="alert-triangle"></i><span>Declaration </span></a>
                            </li>
                            <li class="dropdown {{$subactiveLink === 'user.possesion' ? 'active' : ''}}">
                                <a href="{{ route('declaration.WeaponsDeclaration') }}" class="nav-link"><i data-feather="shield"></i><span>Declaration de possesion</span></a>
                            </li>
                        @endif

                        @if($activeLink === 'armory')

                            <li class="dropdown  {{$subactiveLink === 'dashboard' ? 'active' : ''}}">
                                <a href="{{ route('armory.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                            </li>

                            <li class="dropdown {{ Route::is('weapons_type.index') ? 'active' : '' }}">
                                <a href="{{ route('weapons_type.index') }}" class="nav-link"><i data-feather="bar-chart-2"></i><span>Stock</span></a>
                            </li>

                            <li class="dropdown {{ Route::is('add_arm_sheet') ? 'active' : '' }}">
                                <a href="{{ route('add_arm_sheet') }}" class="nav-link"><i data-feather="file-text"></i><span>Creer fiche d'armes</span></a>
                            </li>

                        @endif
                            @if($activeLink == 'admin')
                                <li class="dropdown">
                                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Armureries</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="nav-link" href="{{route('admin.index')}}">Liste</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Gouverneur</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="nav-link" href="{{route('admin_governor')}}">Liste</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Prefecture</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="nav-link" href="{{route('admin_prefecture')}}">Liste</a></li>
                                    </ul>
                                </li>
                            @endif
                        @if($activeLink === 'minatd')

                            <li class="dropdown {{$subactiveLink === 'minatd.armory' ? 'active' : ''}}">
                                    <a href="{{ route('minatd_armory') }}" class="nav-link"><i data-feather="crosshair"></i><span>Armureries</span></a>
                                </li>

                                <li class="dropdown {{$subactiveLink === 'minatd.fiche' ? 'active' : ''}}">
                                    <a href="{{ route('minatd.index') }}" class="nav-link"><i data-feather="file-text"></i><span>Fiche D'armes</span></a>
                                </li>

                                <li class="dropdown {{$subactiveLink === 'minatd.prefecture' ? 'active' : ''}}">
                                    <a href="{{ route('minatd_prefecture') }}" class="nav-link"><i data-feather="map-pin"></i><span>Prefecture</span></a>
                                </li>

                                <li class="dropdown {{$subactiveLink === 'minatd.governor' ? 'active' : ''}}">
                                    <a href="{{ route('minatd_governor') }}" class="nav-link"><i data-feather="map-pin"></i><span>Gouvernorats</span></a>
                                </li>

                                <li class="dropdown {{$subactiveLink === 'minatd.weapon_lost' ? 'active' : ''}}">
                                    <a href="{{route('lost_arm')}}" class="nav-link"><i data-feather="shield"></i><span>Arme Perdue</span></a>
                                </li>
                        @endif


                        @if($activeLink === 'governor')
                                <li class="dropdown {{$subactiveLink === 'governor.armory' ? 'active' : ''}}">
                                    <a href="{{ route('governor_armory') }}" class="nav-link"><i data-feather="crosshair"></i><span>Armureries</span></a>
                                </li>

                                <li class="dropdown {{$subactiveLink === 'governor.fiche' ? 'active' : ''}}">
                                    <a href="{{ route('governor.index') }}" class="nav-link"><i data-feather="file-text"></i><span>Fiche D'armes</span></a>
                                </li>

                                <li class="dropdown {{$subactiveLink === 'governor.weapon_lost' ? 'active' : ''}}">
                                    <a href="{{route('governor_lost_arm')}}" class="nav-link"><i data-feather="shield"></i><span>Arme Perdue</span></a>
                                </li>
                        @endif

                        @if($activeLink === 'prefecture')
                                <li class="dropdown {{$subactiveLink === 'prefecture.armory' ? 'active' : ''}}">
                                    <a href="{{ route('prefecture_armory') }}" class="nav-link"><i data-feather="crosshair"></i><span>Armureries</span></a>
                                </li>

                                <li class="dropdown {{$subactiveLink === 'prefecture.fiche' ? 'active' : ''}}">
                                    <a href="{{ route('prefecture.index') }}" class="nav-link"><i data-feather="file-text"></i><span>Fiche D'armes</span></a>
                                </li>

                                <li class="dropdown {{$subactiveLink === 'prefecture.weapon_lost' ? 'active' : ''}}">
                                    <a href="{{route('prefecture_lost_arm')}}" class="nav-link"><i data-feather="shield"></i><span>Arme Perdue</span></a>
                                </li>
                        @endif


                    </ul>
                </aside>
            </div>
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

        </div>
    </div>
    <script src="{{asset('assets/js/app.min.js')}}"></script>

    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <!-- Custom JS File -->
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/page/sweetalert.js') }}"></script>



    @yield('scripts')
    @stack('other-scripts')
</body>

</html>
