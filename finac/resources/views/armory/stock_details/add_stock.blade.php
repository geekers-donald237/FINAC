@php
    $activeLink = 'armory';
    $subactiveLink = 'weapons.stock';

@endphp
@extends('layouts.backend')

@section('style')
    <style>
    </style>
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-primary text-white-all">
                    <li class="breadcrumb-item"><a href="{{route('armory.index')}}"><i class="fas fa-building"></i>Armueries</a>
                    </li>
                    <li class="breadcrumb-item"><a href="weapons_type.index"><i class="fas fa-cubes"></i>Stock</a></li>
                    <li class="breadcrumb-item"><a href="#">Ajouter</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Ajouter Stock</h4>
                </div>
                <form method="POST" action="{{ route('weapons_type.store') }}">
                    <div class="card-body">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="form-group col">
                                <label class="form-label">Type de L'arme</label>
                                <input type="text" class="form-control" placeholder="Type de l'arme" name="type">
                                <input type="hidden" class="form-control" name="armory_id" value="{{$armoryId}}">
                            </div>
                            <div class="form-group col">
                                <label for="quantity">Quantité</label>
                                <input type="number" class="form-control" placeholder="Quantité" name="quantity"
                                       id="quantityInput">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" placeholder="description" class="form-control"></textarea>
                        </div>
                        <br>
                        <div class="row" id="serialNumbersContainer">
{{--                            add serial number input --}}
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <button type="submit" class="btn btn-primary" id="addMoreWeapons">Ajouter</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

<!-- Assurez-vous d'inclure jQuery avant ce script -->
<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>

<script>
    $(document).ready(function () {
        // Récupérer le champ de quantité et le conteneur pour les numéros de série
        var quantityInput = $('#quantityInput');
        var serialNumbersContainer = $('#serialNumbersContainer');

        // Ajouter un gestionnaire d'événements pour détecter les changements dans le champ de quantité
        quantityInput.on('input', updateSerialNumberFields);

        function updateSerialNumberFields() {
            // Récupérer la quantité saisie
            var quantity = quantityInput.val();

            // Effacer les champs de saisie existants
            serialNumbersContainer.html('');

            // Générer les nouveaux champs de saisie en fonction de la quantité
            for (var i = 1; i <= quantity; i++) {
                var inputGroup = $('<div class="form-group col-md-6"></div>'); // Utilisez col-md-6 pour que deux éléments s'affichent côte à côte
                var input = $('<input>').attr({
                    type: 'text',
                    class: 'form-control',
                    name: 'serialnumber[]',
                    placeholder: 'Numéro de série ' + i
                });
                inputGroup.append(input);
                serialNumbersContainer.append(inputGroup);

                // Ajouter une nouvelle ligne toutes les deux colonnes
                if (i % 2 === 0) {
                    serialNumbersContainer.append('</div><div class="row"><div class="form-group col" id="serialNumbersContainer">');
                }
            }
        }
    });
</script>
