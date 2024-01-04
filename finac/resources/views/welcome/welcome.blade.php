<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Acceuil</title>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('asset/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/logo_finac.jpg')}}">

</head>
<body>
<div class="site-wrap">
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <header class="site-navbar pt-1 js-sticky-header site-navbar-target" role="banner">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <div class="site-logo mr-auto w-25">
                    <a href="{{route('home')}}">
                        <img src="{{ asset('asset/images/cameroun-flag.png') }}" width="60" height="45"
                             alt="drapeau_cameroun" class="flag-icon">
                    </a>
                </div>

                <div class="mx-auto text-center">
                    @guest()
                        <nav class="site-navigation position-relative navbar navbar-expand-lg text-right"
                             role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                                <li><a href="{{route('home')}}" class="active nav-link">Acceuil</a></li>
                                <li><a href="{{route('info_contact')}}" class="nav-link">Infos & Contact</a></li>
                                <li><a href="{{route('add_armory')}}" class="nav-link">Creer une Armurerie</a></li>
                            </ul>
                        </nav>
                    @endguest
                </div>

                <div class="ml-auto">
                    <nav class="site-navigation position-relative navbar navbar-expand-lg  text-right"
                         role="navigation">
                        <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                            @auth
                                <li class=" btn ctav">
                                    <a href="{{route('logout')}}" class="nav-link text-primary"><span>Logout</span></a>
                                </li>
                            @endauth
                            @guest
                                <li class="btn cta2">
                                    <a href="#" data-toggle="modal" data-target="#LoginPopupModal"
                                       class="nav-link"><span>Connexion</span></a>
                                </li>
                            @endguest
                        </ul>
                    </nav>
                    <a href="#"
                       class="d-inline-block-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span
                            class="icon-menu h3"></span></a>
                </div>
            </div>

            <div class="row mt-3 align-items-center">
                <div class="col-md-12 text-light text-center mx-auto">
                    <div class="text-container">
                        <h2 data-aos="fade-up" data-aos-delay="200"
                            style="font-family: 'Arial', sans-serif; letter-spacing: 1px; line-height: 1.2;">Ministere
                            de L'Administration Territoriale et de la Decentralisation</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-6 text-light">
                    <div class="col mt-5 d-flex flex-column align-items-end">
                        <!-- Ajout de la classe d-flex pour activer les flexbox et flex-column pour la disposition en colonne -->
                        <div class="container mt-5">
                            <div class="col-12">
                                <div class="text-container  d-flex flex-column align-items-center">
                                    <h3 data-aos="fade-up" data-aos-delay="100"
                                        style="font-family: 'Arial', sans-serif; letter-spacing: 2px; line-height: 1.2; margin-bottom: 10px;">
                                        FICHIER NATIONAL DES ARMES CIVILES.</h3>
                                    <p data-aos="fade-up" data-aos-delay="200"
                                       style="font-family: 'Arial', sans-serif; letter-spacing: 2px; line-height: 1.2; margin-bottom: 10px;">
                                        Contrôle - gestion - sécurisation - traçabilité</p>
                                </div>
                                @guest
                                    <div class="row" style="margin-top: 45%">
                                        <div class="cta3">
                                            <a href="" data-toggle="modal" data-target="#LostWeaponDeclarationModal" class="nav-link">
                                                <span>Déclaration de perte d'arme</span>
                                            </a>
                                        </div>
                                        <div class="cta4">
                                            <a href="{{ route('declaration.WeaponsDeclaration') }}" class="nav-link">
                                                <span>Déclaration de possession d'Arme</span>
                                            </a>
                                        </div>
                                    </div>
                                @endguest
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('asset/images/logo_finac.jpg')}}" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
        <div>
        </div>
    </header>


</div>

<div class="modal fade" id="LostWeaponDeclarationModal" tabindex="-1" role="dialog" aria-labelledby="LostWeaponDeclarationModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LostWeaponDeclarationModalTitle">Declaration de perte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('declaration.check') }}">
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
                        <input type="submit" value="Verifier" class="btn btn-primary w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="LoginPopupModal" tabindex="-1" role="dialog" aria-labelledby="LoginPopupModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LoginPopupModalTitle">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="login">Login <span class="text-danger">*</span></label>
                        <input type="text" name="login" class="form-control" placeholder="Login"
                               autocomplete="login" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Entrer votre mot de passe" autofocus min="8" required>
                    </div>
                    <div class="btn-box pt-3 pb-4">
                        <input type="submit" value="Connexion" class="btn btn-primary w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('asset/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('asset/js/jquery-ui.js') }}"></script>
<script src="{{ asset('asset/js/popper.min.js') }}"></script>
<script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('asset/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('asset/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('asset/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('asset/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('asset/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('asset/js/aos.js') }}"></script>
<script src="{{ asset('asset/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('asset/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('asset/js/main.js') }}"></script>
</body>
</html>



