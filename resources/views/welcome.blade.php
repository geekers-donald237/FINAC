@extends('layouts.template')

@section('style')
    <style>
    </style>
@endsection

@section('content')
    <div class="site-wrap">
        <div class="intro-section" id="home-section">
            <div class="slide-1" style="background-image: url('{{ asset('asset/images/hero_1.jpg') }}')"
                 data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4">
                                    <h1 data-aos="fade-up" data-aos-delay="100">Apprenez auprès des experts</h1>
                                    <p class="mb-4" data-aos="fade-up" data-aos-delay="200">Bienvenue sur notre
                                        plateforme
                                        de gestion des inscriptions, notes et bulletins pour les lycées et établissements
                                        primaires. Nous vous offrons un outil complet et intuitif pour simplifier la gestion
                                        administrative et améliorer le suivi des élèves.</p>
                                    @auth
{{--                                        <p data-aos="fade-up" data-aos-delay="300"><a href="{{ route('parent_index') }}"--}}
{{--                                                                                      class="btn btn-primary py-3 px-5 btn-pill">Dashboard</a></p>--}}
                                    @endauth
                                    @guest
                                        <li class="cta">
                                            <a href="#" data-toggle="modal" data-target="#signupPopupParent"
                                               class="nav-link"><span>Creer un Compte</span>
                                            </a>
                                        </li>
                                    @endguest
                                </div>
                                @guest
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12 mt-2">
                    <div class="border-top">
                        <p>
                            Copyright &copy;<script>2023;</script> by <a href="#" >SOS Home</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection

{{--<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>--}}
{{--<script>--}}

{{--    $(document).ready(function() {--}}
{{--        // Initialisation--}}
{{--        $("#error_div").hide();--}}
{{--        var currentStep = 1;--}}

{{--        // Fonction pour afficher un message d'erreur--}}
{{--        function showError(message) {--}}
{{--            $("#error").text(message);--}}
{{--            $("#error_div").show();--}}
{{--            setTimeout(function() {--}}
{{--                $("#error_div").hide();--}}
{{--            }, 3000); // Masquer après 3 secondes--}}
{{--        }--}}

{{--        // Fonction pour gérer l'étape 1 (vérification de l'e-mail)--}}
{{--        function handleStep1() {--}}
{{--            email = $("#email").val();--}}

{{--            // Validez l'e-mail en utilisant une requête AJAX--}}
{{--            $.ajax({--}}
{{--                type: 'POST',--}}
{{--                url: "{{ route('check_email') }}",--}}
{{--                data: { email: email, _token: $('meta[name="csrf-token"]').attr('content') },--}}
{{--                success: function(data) {--}}
{{--                    if (data) {--}}
{{--                        alert("Veuillez entrer votre code de vérification.");--}}
{{--                        // L'e-mail est valide, rendez le champ email en lecture seule--}}

{{--                        // Rendez le champ de code de vérification éditable--}}
{{--                        $('#formgroupcode').css('display' , 'block');--}}
{{--                        $("#verification_code").prop("readonly", false);--}}
{{--                        $("#email").prop("readonly", true);--}}

{{--                        // Passez à l'étape suivante--}}
{{--                        currentStep = 2;--}}

{{--                    } else {--}}
{{--                        showError('Email Invalide');--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function(data) {--}}
{{--                    console.log("Erreur de requête AJAX");--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        // Fonction pour gérer l'étape 2 (vérification du code)--}}
{{--        function handleStep2() {--}}
{{--            var code = $("#verification_code").val();--}}

{{--            // Validez le code en utilisant une requête AJAX--}}
{{--            $.ajax({--}}
{{--                type: 'POST',--}}
{{--                url: "{{ route('verify_code') }}", // Assurez-vous que cette route est correcte--}}
{{--                cache: false, // Désactiver la mise en cache--}}
{{--                data: { code: code, email: email, _token: $('meta[name="csrf-token"]').attr('content') },--}}
{{--                success: function(response) {--}}
{{--                    if (response !== '1') {--}}
{{--                        $("#verification_code").prop("readonly", true);--}}
{{--                        $("#email").prop("readonly", true);--}}
{{--                        $('#formgrouppass').css('display' , 'block');--}}
{{--                        $("#new_password").prop("readonly", false);--}}

{{--                        // Affichez le bouton "Terminer" au lieu du bouton "Suivant"--}}
{{--                        $("#nextStep").text("Terminer");--}}
{{--                        currentStep = 3;--}}
{{--                    } else {--}}
{{--                        showError('Code Incorrect');--}}

{{--                    }--}}
{{--                },--}}
{{--                error: function(response) {--}}
{{--                    console.log("Erreur de requête handle 3 AJAX");--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        // Bouton "Suivant" ou "Terminer" pour passer à l'étape suivante ou terminer le processus--}}
{{--        $("#nextStep").click(function() {--}}
{{--            if (currentStep === 1) {--}}
{{--                handleStep1();--}}
{{--            } else if (currentStep === 2) {--}}
{{--                handleStep2();--}}
{{--            } else if (currentStep === 3) {--}}
{{--                // Gérez la 3ème étape ici--}}
{{--                var newPassword = $("#new_password").val();--}}
{{--                // Validez et mettez à jour le nouveau mot de passe en utilisant une requête AJAX--}}
{{--                $.ajax({--}}
{{--                    type: 'POST',--}}
{{--                    url: "{{ route('update_password') }}", // Assurez-vous que cette route est correcte--}}
{{--                    data: { email: email, new_password: newPassword, _token: $('meta[name="csrf-token"]').attr('content') },--}}
{{--                    success: function(data) {--}}
{{--                        if (data.message === 'Mot de passe trop court') {--}}
{{--                            showError("mot de passe trop court");--}}
{{--                        } else if (data.message === 'Mot de passe mis à jour avec succès') {--}}
{{--                            location.reload();--}}
{{--                            alert('Mot de passe mis à jour avec succès');--}}
{{--                            // Redirigez ou effectuez d'autres actions nécessaires ici--}}
{{--                        }else {--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function(data) {--}}
{{--                        console.log("Erreur de requête AJAX");--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}


{{--    var stateSelect = document.getElementById("state_name");--}}
{{--    var townSelect = document.getElementById("cities_name");--}}

{{--    function changestate(selectElement) {--}}

{{--        var selectedCountry = 37;--}}

{{--        stateSelect.innerHTML = "";--}}

{{--        var states = {{ Js::from($states) }};--}}

{{--        for (var i = 0; i < states.length; i++) {--}}
{{--            if (states[i].country_id == selectedCountry) {--}}
{{--                var option = document.createElement("option");--}}
{{--                option.value = states[i].id;--}}
{{--                option.textContent = states[i].name;--}}
{{--                stateSelect.appendChild(option);--}}
{{--            }--}}
{{--        }--}}
{{--        changetown(stateSelect);--}}
{{--    };--}}

{{--    function changetown(selectElement) {--}}

{{--        var selectedTown = selectElement.value;--}}

{{--        townSelect.innerHTML = "";--}}

{{--        var towns = {{ Js::from($towns) }};--}}

{{--        for (var i = 0; i < towns.length; i++) {--}}
{{--            if (towns[i].state_id == selectedTown) {--}}
{{--                var option = document.createElement("option");--}}
{{--                option.value = towns[i].id;--}}
{{--                option.textContent = towns[i].name;--}}
{{--                townSelect.appendChild(option);--}}
{{--            }--}}
{{--        }--}}
{{--    };--}}


{{--</script>--}}
