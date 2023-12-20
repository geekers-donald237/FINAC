@php
    $activeLink = 'user';
    $subactiveLink = 'user.possesion'

@endphp
@extends('layouts.backend')

@section('style')
    <style>
    </style>
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-md-12 ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-primary text-white-all">
                    <li class="breadcrumb-item"><a href=""><i class="fas fa-building"></i>Declaration</a></li>
                    <li class="breadcrumb-item"><a ><i class="fas fa-cubes"></i>Possesion D'armes</a></li>
                </ol>
            </nav>
        </div>

    </div>


    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Déclaration de possession d'arme</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('declarationarmes.store')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate onsubmit="afficherAlerte()>
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="form-group col">
                                <label for="nom">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom" name="noms" placeholder="Nom" required>
                            </div>

                            <div class="form-group col">
                                <label for="prenom">Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="date">Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
                            </div>

                            <div class="form-group col">
                                <label for="circonstance">Circonstance <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" id="circonstance" name="circonstance" placeholder="Circonstance" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="numero_serie">Numéro de série <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="numero_serie" name="numero_serie" placeholder="Numéro de série" required>
                            </div>

                            <div class="form-group col">
                                <label for="marque">Marque<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="marque" name="marque" placeholder="Marque" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="telephone">Numéro de téléphone<span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Numéro de téléphone" required>
                            </div>

                            <div class="form-group col">
                                <label for="email">E-mail<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="photo_recto">Photo recto<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="photo_recto" name="photo_recto" placeholder="Photo recto" required>
                            </div>

                            <div class="form-group col">
                                <label for="photo_verso">Photo verso<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="photo_verso" name="photo_verso" placeholder="Photo verso" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="adresse">Adresse<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" required>
                            </div>

                            <div class="form-group col">
                                <label for="photo">Photo de l'arme<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="photo" name="photo" placeholder="Photo de l'arme" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="declaration" name="declaration" required>
                                    <label class="form-check-label" for="declaration">
                                        Je déclare avoir une arme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Déclarer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        function afficherAlerte() {
            if (document.getElementById('declaration').checked) {
                alert('Vendre ou donner');
            } else {
                alert('Autre message si la case n\'est pas cochée');
            }
        }
    </script>

@endsection
