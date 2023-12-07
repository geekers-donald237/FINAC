
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
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-primary text-white-all">
                    <li class="breadcrumb-item"><a href="{{route('armory.index')}}"><i class="fas fa-building"></i>Armueries</a></li>
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-cubes"></i>stock d'armes </a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-auto">
            <nav aria-label="breadcrumb">
                <a class="btn btn-success btn-pilll" data-toggle="modal" data-target="#addWeaponStockModal" href="#">
                    Ajouter Un stock d'arme
                </a>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Weapons Type</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Weapons Type</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($weaponTypes as $index => $weaponType)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $weaponType->type }}</td>
                                    <td>{{ $weaponType->quantity }}</td>
                                    <td>{{ $weaponType->description }}</td>
                                    <td>
                                        <a class="btn btn-warning btn-action mr-1" onclick="edit_weapons_type({{ json_encode($weaponType->id) }});" title="Editer">
                                            Editer
                                        </a>
                                        <a class="btn btn-danger btn-action" onclick="event.preventDefault();delete_weapons_type({{json_encode($weaponType->id)}});" title="Supprimer">
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
    <div class="modal fade" id="addWeaponStockModal" tabindex="-1" role="dialog" aria-labelledby="addWeaponStockModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('weapons_type.store') }}">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="addWeaponStockModalLabel">Ajouter un stock d'armes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="weaponsList">
                            <!-- Champs d'arme initiaux -->
                            <div class="weaponFields">
                                <div class="form-group">
                                    <p>Numéro d'arme : 1</p>
                                    <label for="type">Type d'arme</label>
                                    <input type="text" class="form-control" placeholder="Type de l'arme" name="type[]">
                                    <input type="hidden" class="form-control"  name="armory_id" value="{{$armoryId}}">

                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantité</label>
                                    <input type="number" class="form-control" placeholder="quantie"   name="quantity[]">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description[]" placeholder="description" class="form-control"></textarea>
                                </div>
                            </div>
                            <hr class="hr" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="addMoreWeapons">Ajouter un stock</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-popup">
        <div class="modal fade" id="editWeaponTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLevelModalLabel">Editer le Stock</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="contact-form-action">
                            <form action="" method="POST" style="width: 100%" id="editTypeWeaponsForm" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="type">Type d'arme</label>
                                        <input type="text" class="form-control" id="type_update" placeholder="Type de l'arme" name="type">
                                    </div>
                                    <input type="hidden" id="id_weapons_update" name="id_weapon">
                                    <div class="form-group">
                                        <label for="quantity">Quantité</label>
                                        <input type="number" class="form-control" id="quantity_update" placeholder="quantite" name="quantity">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">description</label>
                                        <textarea name="description" class="form-control" placeholder="description" id="description_update"></textarea>                        </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-info">Editer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>

<script type="text/javascript">

    function delete_weapons_type(id) {
        swal({
            title: 'Suppression',
            text: 'Voulez vous vraiment supprimer ??',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var url = "/weapons_type/" + id;
                    var xhr = new XMLHttpRequest();
                    xhr.open('DELETE', url);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            console.log(response);
                            if (response === 'ok') {
                                location.reload();
                                iziToast.success({
                                    title: 'Message',
                                    message: 'Suppression réussie',
                                    position: 'topRight'
                                });

                            } else if (response === 'off') {
                                iziToast.error({
                                    title: 'Message!',
                                    message: 'Une erreur s\'est produite',
                                    position: 'topRight'
                                });
                                // location.reload();
                            } else {
                                iziToast.error({
                                    title: 'Message!',
                                    message: 'Ce niveau a des classes et éleves liées à lui',
                                    position: 'topRight'
                                });
                                // location.reload();
                            }
                        } else {
                            iziToast.error({
                                title: 'Message!',
                                message: 'Une erreur s\'est produite',
                                position: 'topRight'
                            });
                            // location.reload();
                        }
                    };
                    xhr.send();
                } else {}
            });
    }

    function edit_weapons_type(id) {
        var de = document.getElementById('editTypeWeaponsForm')
        de.setAttribute('action', '/weapons_type/' + id);
        var urls = "/weapons_type/" + id;
        $.ajax({
            url: urls,
            type: 'GET',
            success: function(data) {
                if (data === 'off') {
                    console.log('error getting')
                } else {
                    console.log(data);
                    $('#type_update').val(data.type);
                    $('#id_weapons_update').val(data.id);
                    $('#quantity_update').val(data.quantity);
                    $('#description_update').val(data.description);

                }
            }
        });
        $('#editWeaponTypeModal').modal('show');
    }


    $(document).ready(function() {
        var wrapper = $("#weaponsList");
        var addButton = $("#addMoreWeapons");

        var x = 1; // Initial input box count
        $(addButton).click(function(e) {
            e.preventDefault();
            if (x < 2) { // Limite le nombre d'armes à 10
                x++;
                $(wrapper).append(
                    '<div class="weaponFields">' +
                    '<div class="form-group">' +
                    '<p>Numéro d\'arme : ' + x + '</p>' +
                    '<label for="type">Type d\'arme</label>' +
                    '<input type="text" class="form-control" placeholder="type de l\'arme" name="type[]">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="quantity">Quantité</label>' +
                    '<input type="number" class="form-control" placeholder="quantite" name="quantity[]">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="description">Description</label>' +
                    '<textarea name="description[]" placeholder="description" class="form-control"></textarea>' +
                    '</div>' +
                    '</div>'
                );
            }
            if (x === 2){
                addButton.css("display", "none"); // Pour rendre invisible
            }
        });
    });

</script>


