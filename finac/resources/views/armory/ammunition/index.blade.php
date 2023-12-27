@php
    $activeLink = 'armory';
        $subactiveLink = 'ammunition.stock';

@endphp
@extends('layouts.backend')

@section('content')
    <div class="row justify-content-between">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-primary text-white-all">
                    <li class="breadcrumb-item"><a href="{{ route('armory.index') }}"><i class="fas fa-building"></i>Armureries</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-cubes"></i>Munitions</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-4 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAmmoModal">
                <i class="fas fa-plus"></i> Ajouter un stock de munitions
            </button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sellAmmoModal">
                <i class="fas fa-shopping-cart"></i> Vendre des munitions
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Liste Munitions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom de la munition</th>
                                <th scope="col">Type de munition</th>
                                <th scope="col">Calibre</th>
                                <th scope="col">Quantité en stock</th>
                                <th scope="col">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ammunitions as $key => $ammo)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $ammo->name }}</td>
                                    <td>{{ $ammo->type }}</td>
                                    <td>{{ $ammo->caliber }}</td>
                                    <td>{{ $ammo->quantity_in_stock }}</td>
                                    <td>
                                        <a class="btn btn-warning btn-action mr-1"
                                           onclick="edit_ammunition({{ json_encode($ammo->id) }});"
                                           title="Editer">
                                            Editer
                                        </a>
                                        <a class="btn btn-danger btn-action"
                                           onclick="event.preventDefault(); delete_ammunition({{ json_encode($ammo->id) }});"
                                           title="Supprimer">
                                            Supprimer
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sellAmmoModal" tabindex="-1" role="dialog" aria-labelledby="sellAmmoModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sellAmmoModalLabel">Vendre des munitions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('sale-ammunitions') }}">
                        @csrf
                        @method('post')

                        <div class="form-group">
                            <label for="selectAmmo">Sélectionner la munition</label>
                            <select class="form-control" id="selectAmmo" name="selectAmmo">
                                @foreach ($ammunitions as $ammunition)
                                    <option
                                        value="{{ $ammunition->id }}">{{ $ammunition->name ." ". $ammunition->type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantité à vendre</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                   placeholder="Entrez la quantité">
                        </div>

                        <button type="submit" class="btn btn-primary">Vendre</button>
                    </form>

                </div>

            </div>
        </div>
    </div>



    <div class="modal fade" id="editAmmoModal" tabindex="-1" role="dialog" aria-labelledby="editAmmoModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAmmoModalLabel">Éditer un stock de munitions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="post" id="editAmmoForm">
                        @csrf
                        @method('PUT') <!-- Ajoutez cette ligne pour indiquer que c'est une requête PUT -->

                        <div class="form-group">
                            <label for="edit_name">Nom de la munition</label>
                            <input type="text" class="form-control" id="edit_name" name="edit_name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_type">Type de munition</label>
                            <input type="text" class="form-control" id="edit_type" name="edit_type" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_caliber">Calibre</label>
                            <input type="text" class="form-control" id="edit_caliber" name="edit_caliber" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_quantity_in_stock">Quantité en stock</label>
                            <input type="number" class="form-control" id="edit_quantity_in_stock"
                                   name="edit_quantity_in_stock" required>
                        </div>

                        <!-- Bouton de soumission du formulaire -->
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addAmmoModal" tabindex="-1" role="dialog" aria-labelledby="addAmmoModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAmmoModalLabel">Ajouter un stock de munitions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{ route('ammunition.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nom de la munition</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Type de munition</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>
                        <div class="form-group">
                            <label for="caliber">Calibre</label>
                            <input type="text" class="form-control" id="caliber" name="caliber" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity_in_stock">Quantité en stock</label>
                            <input type="number" class="form-control" id="quantity_in_stock" name="quantity_in_stock"
                                   required>
                        </div>

                        <!-- Bouton de soumission du formulaire -->
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>

<script type="text/javascript">
    var csrfToken = "{{ csrf_token() }}";

    function delete_ammunition(id) {
        swal({
            title: 'Suppression',
            text: 'Voulez-vous vraiment supprimer ??',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var url = "/ammunition/" + id;
                    var xhr = new XMLHttpRequest();
                    xhr.open('DELETE', url);
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            console.log(response);
                            if (response === 'done') {
                                location.reload();
                            } else if (response === 'error') {
                                // location.reload();
                            } else {
                                // Handle other cases
                            }
                            location.reload();
                        } else {
                            location.reload();
                        }
                    };
                    xhr.send();
                } else {
                    // Handle 'Cancel' case
                }
            });
    }

    function edit_ammunition(id) {
        var editForm = document.getElementById('editAmmoForm');
        var editModal = $('#editAmmoModal');

        // Configurer l'action du formulaire avec l'URL d'édition appropriée
        editForm.setAttribute('action', '/ammunition/' + id);

        // Effectuer une requête AJAX pour obtenir les données de la munition à éditer
        $.ajax({
            url: '/ammunition/' + id,
            type: 'GET',
            success: function (data) {
                console.log(data);
                if (data === 'off') {
                    console.log('Erreur lors de la récupération des données');
                } else {
                    // Remplir les champs du formulaire avec les données de la munition
                    $('#edit_name').val(data.name);
                    $('#edit_type').val(data.type);
                    $('#edit_caliber').val(data.caliber);
                    $('#edit_quantity_in_stock').val(data.quantity_in_stock);

                    // Afficher la modal d'édition
                    editModal.modal('show');
                }
            },
            error: function () {
                console.log('Erreur lors de la requête AJAX');
            }
        });
    }


</script>

