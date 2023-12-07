<!DOCTYPE html>
<html lang="fr">
<head>
    <title>FINAC - Acceuil</title>

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


    @yield('style')


</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    @include('layouts.header')


    @yield('content')

    <!-- Pour la modal de connexion -->
    <div class="modal fade" id="LoginPopupModal" tabindex="-1" role="dialog" aria-labelledby="LoginPopupModalTitle" aria-hidden="true">
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
                            <input type="text" name="login" class="form-control" placeholder="Login" autocomplete="login" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Entrer votre mot de passe" autofocus min="8" required>
                        </div>
                        <div class="btn-box pt-3 pb-4">
                            <input type="submit" value="Connexion" class="btn btn-primary w-100">
                        </div>
                    </form>
                </div>
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



