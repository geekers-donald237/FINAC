@extends('layouts.template')

@section('content')

    <div class="site-wrap">
        <div class="intro-section" id="home-section">
            <div class="slide-1" style="background-image: url('{{ asset('asset/images/normal.jpg') }}'); opacity: 1 " data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="row  align-items-center">
                                <h1 data-aos="fade-up" data-aos-delay="100">Contrôle et gestion des armes avec FINAC</h1>
                                <p class="mb-4" data-aos="fade-up" data-aos-delay="200">Bienvenue sur le Fichier National des Armes du Cameroun (FINAC). Notre plateforme est dédiée à la gestion complète et sécurisée des armes à l'échelle nationale. FINAC offre un outil avancé facilitant le suivi et la régulation des armes sur le territoire, garantissant une gestion administrative transparente et rigoureuse. Avec des fonctionnalités intuitives, notre objectif est de renforcer la sécurité et le contrôle des armes, offrant ainsi un mécanisme de suivi et de gestion des stocks pour une meilleure gouvernance nationale.</p>
                                @guest
                                    <li class="cta3">
                                        <a href="#" class="nav-link" data-toggle="modal" data-target="#lossDeclarationModal">
                                            <span>Déclaration de Pertes</span>
                                        </a>
                                    </li>

                                    <li class="cta4">
                                        <a href="" class="nav-link ">
                                            <span>Déclaration d'Arme</span>
                                        </a>
                                    </li>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         </div>



@endsection
