@php
    $activeLink = 'user';
    $subactiveLink = 'user.declaration.perte'

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
                    <li class="breadcrumb-item"><a><i class="fas fa-cubes"></i>Pertes D'armes</a></li>
                </ol>
            </nav>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Declaration Perte d'armes</h4>
                </div>

                <form action="{{ route('declaration.store')  }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col">
                                <label for="name">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Entrer vos noms" required>
                                <input type="hidden" name="serialNumber" value="{{ decrypt($serialNumber) }}">
                            </div>

                            <div class="form-group col">
                                <label for="surname">Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="surname" name="surname" placeholder="Entrer vos prénoms" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="phone_number">Numéro de téléphone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Votre numéro de téléphone" required>
                            </div>

                            <div class="form-group col">
                                <label for="email">E-mail <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Votre E-mail" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="adresse">Adresse <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" required>
                            </div>
                            <div class="form-group col">
                                <label for="date">Date de pertes <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Commentaires <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Description" required></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Déclarer comme perdu</button>
                        </div>
                    </div>
                </form>

            </div>


        </div>
    </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@endsection
