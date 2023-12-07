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
                <div class="card-body">
                    <form action="{{route('declarationarmes.store')}}" method="POST"  enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="form-group col">
                                <label for="nom">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom" name="noms" placeholder="Nom" required>
                            </div>

                            <div class="form-group col">
                                <label for="prenom">Prenom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" required>
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
                                <label for="date">Numero serie <span class="text-danger">(Optional)</span></label>
                                <input type="text" class="form-control" id="numero_serie" name="numero_serie" placeholder="Numero serie">
                            </div>

                            <div class="form-group col">
                                <label for="marque">Marque<span class="text-danger">(Optional)</span></label>
                                <input type="text" class="form-control" id="marque" name="marque" placeholder="Marque">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="photo">Photo<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="photo" name="photo" placeholder="Photo" required>
                            </div>

                            <div class="form-group col">
                                <label for="adresse">Adresse<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Declarer</button>
                        </div>
                    </form>
                </div>
                </div>


        </div>
    </div>


@endsection
