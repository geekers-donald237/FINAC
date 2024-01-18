<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Info & Contact</title>

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
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner" style="background-color: #0F1111;">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <div class="site-logo mr-auto w-25"><a href="{{route('home')}}"><img src="{{ asset('asset/images/cameroun-flag.png') }}" width="60" height="40" alt="Drapeau Cameroun" class="flag-icon"></a></div>

                <div class="mx-auto text-center">
                    @guest()
                        <nav class="site-navigation position-relative navbar navbar-expand-lg text-right" role="navigation" style="background-color: #0F1111">
                            <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                                <li><a href="{{route('home')}}" class="nav-link">Home</a></li>
                                <li><a href="{{route('info_contact')}}" class="nav-link active">Infos & Contact</a></li>
                                <li><a href="{{route('add_armory')}}" class="nav-link">Creer une Armurerie</a></li>
                            </ul>
                        </nav>
                    @endguest
                </div>
                <div class="ml-auto ">
                    <nav class="site-navigation position-relative navbar navbar-expand-lg  text-right" role="navigation">
                        <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                            @auth
                                <li class="ctav">
                                    <a href="{{route('logout')}}"  class="nav-link text-primary"><span>Logout</span>
                                    </a></li>
                            @endauth
                            @guest


                                <li class="cta2">
                                    <a href="#" data-toggle="modal" data-target="#LoginPopupModal" class="nav-link"><span>Connexion</span>
                                    </a></li>
                            @endguest

                        </ul>
                    </nav>
                    <a href="#" class="d-inline-block-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
                </div>
            </div>
        </div>
    </header>

    <footer class="footer-section text-white" style="background-color: #0F1111">
        <div class="container text-white">
            <div class="row align-items-center">

                <div class="col-md-6">
                    <img src="{{asset('asset/images/logo_finac.jpg')}}" alt="Image" class="img-fluid">
                </div>

                <div class="col-md-6 mb-5">
                    <h3 class="text-white">Contactez-nous</h3>
                    <p>+237 6 60 24 60 60 / +237 6 93 93 31 33
                    </p>
                    <p>infos@soshomecameroun.net
                    </p>
                    <p>Cameroon, Yaoundé, Nsam
                        </p>
                </div>
            </div>


            <div class="row pt-5 mt-5 text-center d-flex justify-content-between">
                <div class="col-md-12">
                    <div class="border-top pt-3">
                        <ul class="align-items-center col-md-12 d-flex justify-content-around list-unstyled footer-links">
                            <li><a href="#" class="text-light">Acceuil</a></li>
                            <li><a href="#" class="text-light">Services</a></li>
                            <li><a href="#" class="text-light">Realisations</a></li>
                            <li><a href="#" class="text-light">A propos</a></li>
                        </ul>
                        <p>
                            Copyright &copy; All rights reserved || <a href="https://soshome-cameroun.net" target="_blank" class="text-light">SOS Home</a>
                        </p>
                    </div>
                </div>
            </div>




        </div>
    </footer>

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



