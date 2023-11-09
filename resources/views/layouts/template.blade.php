<!DOCTYPE html>
<html lang="fr">
<head>
    {{--    <title>WASA @yield('title')</title>--}}
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

    <div class="modal fade" id="LoginPopupModal" tabindex="-1" role="dialog"
         aria-labelledby="LoginPopupModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="LoginPopupModalTitle">Connexion </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('login')}}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <input type="email" name="email" class="form-control"
                                   placeholder="Email" autocomplete="email"
                                   autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control"
                                   placeholder="Entrer votre mot de passe"  autofocus
                                   min="8">
                        </div>
                        <div class="btn-box pt-3 pb-4">
                            <input type="submit" value="Connexion" class="btn btn-primary w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="RegisterPopupModal" tabindex="-1" role="dialog"
         aria-labelledby="RegisterPopupModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RegisterPopupModalTitle">Inscription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('register')}}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <input type="text" name="firstname" class="form-control"
                                   placeholder="Prénom" autofocus required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lastname" class="form-control"
                                   placeholder="Nom" autofocus required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control"
                                   placeholder="Email" autocomplete="email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="telephone" class="form-control"
                                   placeholder="Numéro de téléphone" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control"
                                   placeholder="Mot de passe" min="8" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirm_password" class="form-control"
                                   placeholder="confirmer Mot de passe" min="8" required>
                        </div>
                        <div class="btn-box pt-3 pb-4">
                            <input type="submit" value="Inscription" class="btn btn-primary w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





</div> <!-- .site-wrap -->


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

{{--<script>--}}
{{--    $(document).ready(function() {--}}

{{--        $("#error_div").hide(); // Cachez l'alerte d'erreur initialement--}}

{{--        $("#RegisterForm").submit(function(event) {--}}
{{--            event.preventDefault(); // Empêche la soumission du formulaire par défaut--}}

{{--            // Récupérez les données du formulaire--}}
{{--            var formData = {--}}
{{--                email: $("#email_register").val(),--}}
{{--                name: $("#name").val(),--}}
{{--                surname: $("#surname").val(),--}}
{{--                phone: $("#phone").val(),--}}
{{--                address: $("#address").val(),--}}
{{--                psw: $("#psw").val(),--}}
{{--                cpsw: $("#cpsw").val(),--}}
{{--                _token: $('meta[name="csrf-token"]').attr('content')--}}
{{--            };--}}

{{--            $.ajax({--}}
{{--                type: 'POST',--}}
{{--                url: '{{ route('store_user') }}',--}}
{{--                data: formData,--}}
{{--                success: function(response) {--}}
{{--                    console.log(response.message);--}}
{{--                    if (response.message === 'empty_field') {--}}
{{--                        // Traitement spécifique pour les champs vides--}}
{{--                        console.log('Tous les champs doivent être remplis.');--}}
{{--                    } else if (response.message === 'error_pwd') {--}}
{{--                        // Traitement spécifique pour les erreurs de mot de passe--}}
{{--                        console.log('Les mots de passe ne correspondent pas ou sont trop courts.');--}}
{{--                    } else if (response.message === 'email_in_use') {--}}
{{--                        // Traitement spécifique pour les e-mails déjà utilisés--}}
{{--                        console.log('Cet e-mail est déjà utilisé.');--}}
{{--                    } else if (response.message === 'bad_address') {--}}
{{--                        console.log('mauvaise addresse.');--}}

{{--                    }else {--}}
{{--                        console.log('Vérifiez votre boîte mail');--}}
{{--                        // Tous les champs sont valides, masquer la modal actuelle et ouvrir la modal de vérification--}}
{{--                        // Effectuez une nouvelle requête Ajax pour vérifier le code--}}
{{--                        var verificationData = {--}}
{{--                            email: formData.email,--}}
{{--                            verification_code: $("verification_code2").val(),--}}
{{--                            _token: $('meta[name="csrf-token"]').attr('content')// Utilisez .val() pour obtenir la valeur--}}
{{--                        };--}}

{{--                        $('#signupPopupParent').modal('hide');--}}
{{--                        $('#verifyCodePopupParent').modal('show');--}}

{{--                        $("#VerifyCodeForm").submit(function(e) {--}}
{{--                            e.preventDefault(); // Empêche la soumission du formulaire par défaut--}}

{{--                            var verificationData = {--}}
{{--                                email: formData.email, // Vous pouvez réutiliser la valeur de l'e-mail du premier formulaire--}}
{{--                                verification_code: $("#verification_code2").val(),--}}
{{--                                _token: $('meta[name="csrf-token"]').attr('content')--}}
{{--                            };--}}
{{--                            $.ajax({--}}
{{--                                type: 'POST',--}}
{{--                                url: '{{ route('verify_code_register') }}',--}}
{{--                                data: verificationData,--}}
{{--                                success: function(response) {--}}
{{--                                    console.log(response)--}}
{{--                                    if (response){--}}
{{--                                        // Code de vérification réussi, effectuez des actions nécessaires--}}
{{--                                        console.log('register succesfully');--}}
{{--                                        location.reload();--}}
{{--                                    } else {--}}
{{--                                        // Code de vérification incorrect, affichez un message d'erreur--}}
{{--                                        console.log('Code de vérification incorrect');--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                error: function(response) {--}}
{{--                                    console.log('Erreur de requête AJAX lors de la vérification du code');--}}
{{--                                }--}}
{{--                            });--}}
{{--                        });--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function(response) {--}}
{{--                    console.log('Erreur de requête AJAX');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}

{{--</script>--}}


</body>
</html>



