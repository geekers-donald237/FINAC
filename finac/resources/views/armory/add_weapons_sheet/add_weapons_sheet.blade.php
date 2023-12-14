@php
    $activeLink = 'armory';
    $subactiveLink = 'weapons.sheet';
@endphp
@extends('layouts.backend')

@section('style')
    <style>
    </style>
@endsection

@section('content')
    <div class=" row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-primary text-white-all">
                    <li class="breadcrumb-item"><a href="{{route('armory.index')}}"><i class="fas fa-building"></i>Armueries</a></li>
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-cubes"></i>Ajouter Fiche D'armes</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Ajouter Fiche D'armes</h4>
                </div>
                <form action="{{route('armory.add_arm_sheet')}}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col">
                                <label for="lastname">Nom Complet</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" value="{{ old('fullname') }}" placeholder="Entrez votre nom complet" required>
                            </div>

                            <div class="form-group col">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Entrez votre adresse e-mail" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="telephone">Téléphone</label>
                                <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}" placeholder="Entrez votre numéro de téléphone" required>
                            </div>
                            <div class="form-group col">
                                <label for="profession">Profession</label>
                                <input type="text" name="profession" id="profession" class="form-control" value="{{ old('profession') }}" placeholder="Entrez votre profession" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="identity_number">Scan CNI</label>
                                <input type="file" name="identity_number" id="identity_number" accept = ".pdf" class="form-control" required>
                            </div>
                            <div class="form-group col">
                                <label for="holder_weapons_picture">Photo</label>
                                <input type="file" name="holder_weapons_picture" id="holder_weapons_picture"  accept="image/png, image/gif, image/jpeg" class="form-control" placeholder="Sélectionnez une photo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="buy_permission">Scan Permis d'achat</label>
                                <input type="file" name="buy_permission" accept = ".pdf" id="buy_permission" class="form-control" required>
                            </div>
                            <div class="form-group col">
                                <label for="honor_contract">Contrat sur L'honneur</label>
                                <input type="file" name="honor_contract" accept = ".pdf" id="honor_contract" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="weapon_type">Type d'arme</label>
                                <select name="weapon_type" id="weapon_type" class="form-control" required>
                                    <option value="type d'arme">Type d'arme</option>

                                    @foreach ($weaponTypes as $weaponType)
                                        <option value="{{ $weaponType->id }}" {{ old('weapon_type') == $weaponType->id ? 'selected' : '' }}>
                                            {{ $weaponType->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group col-12 d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="validationCheckbox" required>
                                <label class="form-check-label" for="validationCheckbox">
                                    Je valide que ses donnees sont bien conforme
                                </label>
                            </div>
                            <button type="button" class="btn btn-primary" id="submitBtn" disabled>Ajouter la fiche d'arme</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>

<script>
    $(document).ready(function () {
        // Désactiver initialement le bouton
        $('#submitBtn').prop('disabled', true);

        // Activer/désactiver le bouton en fonction de l'état de la case à cocher
        $('#validationCheckbox').on('change', function () {
            if ($(this).is(':checked')) {
                $('#submitBtn').prop('disabled', false);
            } else {
                $('#submitBtn').prop('disabled', true);
            }
        });

        // Empêcher la soumission du formulaire si la case à cocher n'est pas cochée
        $('#submitBtn').on('click', function () {
            if (!$('#validationCheckbox').is(':checked')) {
                alert("Veuillez valider les données en cochant la case.");
                return false;
            }
            // Si la case est cochée, vous pouvez soumettre le formulaire
            $('form').submit();
        });
    });
</script>

