@extends('layouts.template')

@section('style')
    <style>
    </style>
@endsection

@section('content')

    <div class="site-wrap">
        <div class="intro-section" id="home-section">
            <div class="slide-1" style="background-image: url('{{ asset('asset/images/normal.jpg') }}'); opacity: 1 " data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center text-dark">
                        <div class="col-12">
                            <div class="row  align-items-center">
                                <h1 data-aos="fade-up" data-aos-delay="100">Contrôle et gestion des armes avec FINAC</h1>
                                <p class="mb-4" data-aos="fade-up" data-aos-delay="200">Bienvenue sur le Fichier National des Armes du Cameroun (FINAC). Notre plateforme est dédiée à la gestion complète et sécurisée des armes à l'échelle nationale. FINAC offre un outil avancé facilitant le suivi et la régulation des armes sur le territoire, garantissant une gestion administrative transparente et rigoureuse. Avec des fonctionnalités intuitives, notre objectif est de renforcer la sécurité et le contrôle des armes, offrant ainsi un mécanisme de suivi et de gestion des stocks pour une meilleure gouvernance nationale.</p>
                                @guest
                                    <li class="cta3">
                                        <a href="{{ route('declaration.LossDeclaration') }}" class="nav-link">
                                            <span>Déclaration de Pertes</span>
                                        </a>
                                    </li>

                                    <li class="cta4">
                                        <a href="{{ route('declaration.WeaponsDeclaration') }}" class="nav-link ">
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

        <div class="site-wrap">

            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12 mt-2">
                        <p>
                            Copyright &copy;<script> 2023 ;</script> by <a href="#" >SOS Home</a> All Rights Reserved
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal-popup">
            <div class="modal" id="SaveArmoryModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addLevelModalLabel">Ajouter l'armurerie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="contact-form-action">
                                <form action="{{route('armory.store')}}" method="POST" style="width: 100%" enctype="multipart/form-data" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nom">Nom<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Nom de l'armurerie" name="name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="secteur">Secteur<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="sector" placeholder="Secteur" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="adresse">Adresse<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="address" placeholder="Adresse" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="BP">Boite postale<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mailbox" placeholder="Boite postale" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tel">Téléphone <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" name="phone_number" placeholder="Téléphone" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="agrement">Numéro d'agrément <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="agrement_number" placeholder="Numéro d'agrément" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="license">License <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="license" accept=".doc, .docx, .pdf" placeholder="License" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6 form-group form-float">
                                                <label for="id_state">Région<span class="text-danger">*</span></label>
                                                <select type="2" class="form-control" id="state_name"
                                                        onchange="changetown(this)" name="id_state" required>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6 form-group form-float">
                                                <label for="id_town">Ville<span class="text-danger">*</span></label>
                                                <select type="2" id="cities_name" class="form-control" name="id_town"
                                                        required>
                                                    @foreach ($towns as $town)
                                                        <option value="{{ $town->id }}">{{ $town->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-info">Ajouter</button>
                                    </div>

                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
