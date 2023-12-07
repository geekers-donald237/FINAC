@php
    $activeLink = 'admin';
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
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}"><i class="fas fa-building"></i>Admin</a></li>
                    <li class="breadcrumb-item"><a><i class="fas fa-cubes"></i>Prefecture</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-4 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPrefectureModal">
                <i class="fas fa-plus-circle"></i> Ajouter prefecture
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Liste des Services gouverneur</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Numero Telephone</th>
                                        <th scope="col">Departement</th>
                                        <th scope="col">Options</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allPrefectures as $index => $allPrefecture)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $allPrefecture->name }}</td>
                                            <td>{{ $allPrefecture->email }}</td>
                                            <td>{{ $allPrefecture->phone_number }}</td>
                                            <td>{{ $allPrefecture->departement->name }}</td>
                                            <td>
                                                <a class="btn btn-warning btn-action mr-1" onclick="edit_prefecture({{ json_encode($allPrefecture->id )}});" title="Editer">
                                                    Editer
                                                </a>
                                                <a class="btn btn-danger btn-action" onclick="event.preventDefault();delete_prefecture({{ json_encode($allPrefecture->id) }});" title="Supprimer">
                                                    Supprimer
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('resend.email', $allPrefecture->id) }}" class="btn btn-primary btn-action mr-1" title="Resend">
                                                    Re-envoyer le code
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Ajouter Minatd -->
    <div class="modal fade" id="addPrefectureModal" tabindex="-1" role="dialog" aria-labelledby="addPrefectureModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPrefectureModalLabel">Ajouter Minatd</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contact-form-action">
                        <form action="{{route('prefecture.store')}}" method="POST" style="width: 100%" enctype="multipart/form-data" class="needs-validation" novalidate="">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="form-group col">
                                    <label for="nom">Nom<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Nom du service" name="name" required>
                                </div>
                                <div class="form-group col">
                                    <label for="email">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="BP">Boite postale<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mailbox" placeholder="Boite postale" required>
                                </div>

                                <div class="form-group col">
                                    <label for="tel">Téléphone <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="phone_number" placeholder="Téléphone" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 form-group form-float">
                                        <label for="id_state">Departement<span class="text-danger">*</span></label>
                                        <select type="2" class="form-control" id="departement_id"
                                                onchange="changetown(this)" name="departement_id" required>
                                            @foreach ($departements as $departement)
                                                <option value="{{ $departement->id }}">{{ $departement->name }}</option>
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

    <div class="modal fade" id="editPrefectureModal" tabindex="-1" role="dialog" aria-labelledby="editPrefectureModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPrefectureModalLabel">Modifier Minatd</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contact-form-action">
                        <form action="" method="POST" id="editPrefectureForm" style="width: 100%" enctype="multipart/form-data" class="needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col">
                                    <label for="edit_name">Nom<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Nom du service" id="edit_name" name="edit_name" required>
                                </div>
                                <div class="form-group col">
                                    <label for="edit_email">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="edit_email" name="edit_email" placeholder="Email" required>
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
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 form-group form-float">
                                        <label for="id_state">Departement<span class="text-danger">*</span></label>
                                        <select type="2" class="form-control" id="departement_name"
                                                onchange="changetown(this)" name="edit_departement_id" required>
                                            @foreach ($departements as $departement)
                                                <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-info">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>

<script type="text/javascript">
    var csrfToken = "{{ csrf_token() }}";

    function delete_prefecture(id) {
        swal({
            title: 'Suppression',
            text: 'Voulez-vous vraiment supprimer ??',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var url = "/prefecture/" + id;
                    var xhr = new XMLHttpRequest();
                    xhr.open('DELETE', url);
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.onload = function() {
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
                        } else {
                            // Handle other cases
                        }
                    };
                    xhr.send();
                } else {
                    // Handle 'Cancel' case
                }
            });
    }

    function edit_prefecture(id) {
        var de = document.getElementById('editPrefectureForm')
        console.log(id);
        de.setAttribute('action', '/prefecture/' + id);
        var urls = "/prefecture/" + id;
        $.ajax({
            url: urls,
            type: 'GET',
            success: function(data) {
                if (data === 'off') {
                    console.log('error getting')
                } else {
                    console.log(data);
                    $('#edit_name').val(data.name);
                    $('#edit_email').val(data.email);
                    $('#edit_phone_number').val(data.phone_number);
                    $('#edit_mailbox').val(data.mailbox);
                    $('#edit_email').val(data.email);

                }
            }
        });
        $('#editPrefectureModal').modal('show');
    }

</script>
