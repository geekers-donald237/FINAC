@php
    $activeLink = 'armory';
    $subactiveLink = 'dashboard';
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
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-cubes"></i>Modifier Profil</a></li>
                </ol>
            </nav>
        </div>

    </div>


    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Modifier armurerie</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST" id="editArmoryForm" style="width: 100%" enctype="multipart/form-data" class="needs-validation" novalidate="">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col">
                                <label for="nom">Nom<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Nom de l'armurerie" name="edit_name" id="edit_name" required>
                                <input type="hidden" class="form-control"  name="id_armory" id="id_armory" value="{{$armoryId}}"  required>
                            </div>

                            <div class="form-group col">
                                <label for="secteur">Secteur<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="edit_sector" id="edit_sector" placeholder="Secteur" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="adresse">Adresse<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="edit_address" id="edit_address" placeholder="Adresse" required>
                            </div>

                            <div class="form-group col">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="edit_email" id="edit_email" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="BP">Boite postale<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="edit_mailbox" id="edit_mailbox" placeholder="Boite postale" required>
                            </div>

                            <div class="form-group col">
                                <label for="tel">Téléphone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="edit_phone_number" name="edit_phone_number" placeholder="Téléphone" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6 form-group form-float">
                                <label for="id_state">Departement<span class="text-danger">*</span></label>
                                <select type="2" class="form-control" id="departement_name"
                                        onchange="changetown(this)" name="edit_departement_id" required>
                                    @foreach ($departements as $departement)
                                        <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="agrement">Numéro d'agrément <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_agrement_number" name="edit_agrement_number" placeholder="Numéro d'agrément" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="login">Login<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="login" id="login" placeholder="Login" required>
                            </div>

                            <div class="form-group col">
                                <label for="pwd">Password <span class="text-danger">*</span></label>
                                <input type="pwd" class="form-control" id="pwd" name="pwd" placeholder="pwd" required>
                            </div>
                        </div>
                        <div class="col-12 modal-footer">
                            <button type="submit" class="btn btn-warning">Editer</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>


    </div>
@endsection

<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>

<script>
    $(document).ready(function() {
        var armoryId = $('#id_armory').val();
        edit_armory(armoryId);
    });


</script>

<script type="text/javascript">
    function delete_armory(id) {
        swal({
            title: 'Suppression',
            text: 'Voulez vous vraiment supprimer ??',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var url = "{{ route('armory.destroy', ['armory' => ':id']) }}";
                    url = url.replace(':id', id);

                    var xhr = new XMLHttpRequest();
                    xhr.open('DELETE', url);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            console.log(response);
                            if (response === 'ok') {
                                // location.reload();
                            } else {
                                // location.reload();
                            }
                        }
                    };
                    xhr.send();
                } else {}
            });
    }

    function edit_armory(id) {
        var de = document.getElementById('editArmoryForm')
        de.setAttribute('action', '/armory/' + id);
        var urls = "/armory/" + id;
        $.ajax({
            url: urls,
            type: 'GET',
            success: function(data) {
                if (data === 'off') {
                    console.log(data);
                    console.log('error getting')
                } else {
                    console.log(data);
                    $('#edit_name').val(data.name);
                    $('#id_armory').val(data.id);
                    $('#edit_sector').val(data.sector);
                    $('#edit_address').val(data.address);
                    $('#edit_email').val(data.email);
                    $('#edit_mailbox').val(data.mailbox);
                    $('#edit_phone_number').val(data.phone_number);
                    $('#edit_agrement_number').val(data.agrement_number);
                    $('#login').val(data.generated_login);
                    $('#pwd').val(data.genrated_password);

                }
            }
        });
        $('#EditArmoryModal').modal('show');
    }
</script>
