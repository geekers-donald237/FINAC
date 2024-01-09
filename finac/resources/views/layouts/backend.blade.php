<!DOCTYPE html>
<html lang="fr">
<head>
    <title>FINAC - Dashboard</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/logo_finac.jpg')}}">
</head>
<body data-spy="scroll" data-target=".site-navbar-target"
      style="margin: 0; padding: 0; background: url({{asset('/asset/images/logo_minatd.jpeg')}}) no-repeat center center fixed; background-size: cover;"
      data-offset="300">

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i
                                data-feather="align-justify"></i></a></li>
                    <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a></li>
                </ul>
            </div>
            @auth
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <span class="d-sm-none d-lg-inline-block text-dark">Menu</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            @if($activeLink === 'armory')
                                <a href="{{route('armory.update_details')}}" class="dropdown-item has-icon"> <i
                                        class="far fa-user"></i> Profile
                                </a>
                            @endif
                            <a href="{{ route('logout_dashboard') }}" class="nav-link nav-link-lg--}} text-danger"
                               onclick="document.getElementById('mylogoutid').submit();"> <i
                                    class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            @endauth
        </nav>
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="{{route('home')}}"> <img alt="image" src="{{asset('asset/images/logo_finac.jpg')}}"
                                                      class="header-logo"/>
                        <span class="logo-name">FINAC</span>
                    </a>
                </div>
                <ul class="sidebar-menu">
                    @if($activeLink === 'user')

                        <li class="dropdown {{$subactiveLink === 'user.armory' ? 'active' : ''}}">
                            <a href="{{route('add_armory')}}" class="nav-link"><i data-feather="plus-circle"></i><span>Creer une armurerie</span></a>
                        </li>
                        <li class="dropdown {{$subactiveLink !== 'user.armory' ? 'active' : ''}}">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="briefcase"></i><span>Declaration :</span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown {{$subactiveLink === 'user.declaration.perte' ? 'active' : ''}}">
                                    <a href="{{ route('declaration.loss_weapon') }}" class="nav-link">Pertes
                                        d'armes </a>
                                </li>
                                <li class="dropdown {{$subactiveLink === 'user.possesion' ? 'active' : ''}}">
                                    <a href="{{ route('declaration.WeaponsDeclaration') }}" class="nav-link">Possesion
                                        d'armes</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if($activeLink === 'armory')

                        <li class="dropdown  {{$subactiveLink === 'dashboard' ? 'active' : ''}}">
                            <a href="{{ route('armory.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>

                        <li class="dropdown  {{$subactiveLink === 'weapons.stock' ? 'active' : ''}}">
                            <a href="{{ route('weapons_type.index') }}" class="nav-link"><i
                                    data-feather="bar-chart-2"></i><span>Stock d'armes</span></a>
                        </li>

                        <li class="dropdown  {{$subactiveLink === 'ammunition.stock' ? 'active' : ''}}">
                            <a href="{{route('ammunition.index')}}" class="nav-link"><i data-feather="box"></i><span>Stock de munitions</span></a>
                        </li>

                        <li class="dropdown {{ Route::is('add_arm_sheet') ? 'active' : '' }}">
                            <a href="{{ route('add_arm_sheet') }}" class="nav-link"><i
                                    data-feather="file-text"></i><span>Creer fiche client</span></a>
                        </li>

                    @endif
                    @if($activeLink == 'admin')
                        <li class="{{$subactiveLink === 'admin.armory' ? 'active' : ''}}">
                            <a href="{{route('admin.index')}}" class="nav-link">
                                <i data-feather="crosshair"></i>
                                <span>Armureries</span>
                            </a>
                        </li>

                        <li class="{{$subactiveLink === 'admin.governor' ? 'active' : ''}}">
                            <a href="{{route('admin_governor')}}" class="nav-link">
                                <i data-feather="map-pin"></i>
                                <span>Gouverneur</span>
                            </a>
                        </li>
                    @endif

                    @if($activeLink === 'minatd')

                        <li class="dropdown {{$subactiveLink === 'minatd.armory' ? 'active' : ''}}">
                            <a href="{{ route('minatd_armory') }}" class="nav-link"><i
                                    data-feather="crosshair"></i><span>Armureries</span></a>
                        </li>

                        <li class="dropdown {{$subactiveLink === 'minatd.fiche' ? 'active' : ''}}">
                            <a href="{{ route('minatd.index') }}" class="nav-link"><i
                                    data-feather="file-text"></i><span>Fiche D'armes</span></a>
                        </li>

                        <li class="dropdown {{$subactiveLink === 'minatd.governor' ? 'active' : ''}}">
                            <a href="{{ route('minatd_governor') }}" class="nav-link"><i
                                    data-feather="map-pin"></i><span>Gouvernorats</span></a>
                        </li>

                        <li class="dropdown {{$subactiveLink === 'minatd.weapon_lost' ? 'active' : ''}}">
                            <a href="{{route('lost_arm')}}" class="nav-link"><i data-feather="shield"></i><span>Arme Perdue</span></a>
                        </li>

                        <li class="dropdown {{$subactiveLink === 'minatd.weapon_declared' ? 'active' : ''}}">
                            <a href="{{route('declared_arm')}}" class="nav-link"><i data-feather="check"></i><span>Arme declaree</span></a>
                        </li>
                    @endif

                    @if($activeLink === 'governor')
                        <li class="dropdown {{$subactiveLink === 'governor.armory' ? 'active' : ''}}">
                            <a href="{{ route('governor_armory') }}" class="nav-link"><i
                                    data-feather="crosshair"></i><span>Armureries</span></a>
                        </li>

                        <li class="dropdown {{$subactiveLink === 'governor.fiche' ? 'active' : ''}}">
                            <a href="{{ route('governor.index') }}" class="nav-link"><i
                                    data-feather="file-text"></i><span>Fiche D'armes</span></a>
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

<div class="modal fade" id="LoginLossPopupModal" tabindex="-1" role="dialog" aria-labelledby="LoginLossPopupModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="LoginLossPopupModalTitle">Connexion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('verifylogin.store') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="code_finac">Code Finac <span class="text-danger">*</span></label>
                                <input type="text" name="code_finac" class="form-control" placeholder="Code Finac" autocomplete="Code Finac" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="serial_number">Numero de Serie <span class="text-danger">*</span></label>
                                <input type="text" name="serial_number" class="form-control" placeholder="Entrer votre Numero de Serie"  required>
                            </div>
                            <div class="btn-box pt-3 pb-4">
                                <input type="submit" value="Connexion" class="btn btn-primary w-100">
                            </div>
                        </form>
                    </div>
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
<script src="{{ asset('assets/bundles/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/buttons.flash.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/jszip.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/js/page/datatables.js')}}"></script>

@yield('scripts')
@stack('other-scripts')
</body>
</html>


