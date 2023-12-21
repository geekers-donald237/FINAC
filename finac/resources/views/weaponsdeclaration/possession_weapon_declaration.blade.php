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
                    <li class="breadcrumb-item"><a><i class="fas fa-cubes"></i>Possesion D'armes</a></li>
                </ol>
            </nav>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card  card-primary">
                <div class="card-header">
                    <h4>Declaration Possesion d'armes</h4>
                </div>
                <form action="{{route('declarationarmes.store')}}" method="POST" enctype="multipart/form-data"
                >
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <!-- Personal Information -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="fullname">Nom Complet <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                       placeholder="Entrer vos noms et prenoms" required>
                            </div>

                            <div class="form-group col">
                                <label for="phone_number">Numéro de téléphone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number"
                                       placeholder="Votre numéro de téléphone" required>
                            </div>
                        </div>

                        <div class="row">


                            <div class="form-group col">
                                <label for="email">E-mail <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Votre E-mail" required>
                            </div>

                            <div class="form-group col">
                                <label for="adress">Adresse <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="adress" name="adress"
                                       placeholder="Adresse" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="serial_number">Numéro de série <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="serial_number" name="serial_number"
                                       placeholder="Entrer le numéro de série" required>
                            </div>

                            <div class="form-group col">
                                <label for="weapon_type">Type <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="weapon_type" name="weapon_type"
                                       placeholder="Entrer le type de l'arme" required>
                            </div>
                        </div>


                        <!-- File Uploads -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="cni">Scan de votre CNI <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="cni" name="cni" accept=".pdf" required>
                            </div>

                            <div class="form-group col">
                                <label for="photo">Photo de l'arme <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="photo" name="weapon_picture"
                                       accept="image/*" required>
                            </div>
                        </div>


                        <!-- Address -->
                        <div class="row">
                            <div class="form-group col">
                                <label for="circumstances">Circonstance <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" id="circumstances" name="circumstances"
                                          placeholder="Circonstance" required></textarea>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-info">Je declare posseder cette arme</button>

                    </div>

                </form>
            </div>
        </div>
    </div>



@endsection
