@php
    $activeLink = 'prefecture';
    $subactiveLink = 'prefecture.fiche'

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
                    <li class="breadcrumb-item"><a href="{{route('governor.index')}}"><i class="fas fa-building"></i>Governor</a></li>
                    <li class="breadcrumb-item"><a><i class="fas fa-cubes"></i>Details Fiche d'armes</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{asset( env('APP_URL') .'storage/finac/holder_weapons_picture/'.$holderWeapons->photo)}}" alt="Profile picture"
                         class="rounded-circle img-fluid"  style="width: 100px;height: 100px;object-fit: cover;object-position: center;">
                    <h5 class="my-3">{{$holderWeapons->fullname}}</h5>
                    <p class="text-muted mb-1">{{$holderWeapons->profession}}</p>
                    <p class="text-muted mb-4" id="adress">Bay Area, San Francisco, CA</p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0" id="fullname">{{$holderWeapons->fullname}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0" id="email">{{$holderWeapons->email}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Phone</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0" id="phone">{{$holderWeapons->telephone}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Profession</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0" id="profession">{{$holderWeapons->profession}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Type Arme</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0" id="weapon_type">{{$weapon->weaponType->type}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Numero de serie</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0" id="serial_number">{{$weapon->serial_number}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">CNI</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><a  href="{{ env('APP_URL') . 'storage/finac/identity_number/' .$holderWeapons->identity_number }}" target="_blank" class="btn btn-link download-btn">
                                    <i class="fas fa-download"></i>
                                    {{$holderWeapons->identity_number}}
                                </a></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Permis Armes</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"> <a type="button" href="{{ env('APP_URL') . 'storage/finac/buy_permission/' .$holderWeapons->buy_permission }}" target="_blank" class="btn btn-link download-btn">
                                    <i class="fas fa-download"></i>
                                    {{$holderWeapons->buy_permission}}
                                </a></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Permis Armes</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"> <a type="button" href="{{ env('APP_URL') . 'storage/finac/buy_permission/' .$holderWeapons->buy_permission }}" target="_blank" class="btn btn-link download-btn">
                                    <i class="fas fa-download"></i>
                                    {{$holderWeapons->buy_permission}}
                                </a></p>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Certificat Moralite</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><a  href="{{ env('APP_URL') . 'storage/finac/identity_number/' .$holderWeapons->identity_number }}" target="_blank" class="btn btn-link download-btn">
                                    <i class="fas fa-download"></i>
                                    {{$holderWeapons->identity_number}}
                                </a></p>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-success mr-2 text-white"  onclick="showConfirmationDialog({{json_encode($id)}})" >Valider la fiche d'arme</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#motifRefusModal">
                                Rejeter
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Modale -->
    <div class="modal fade" id="motifRefusModal" tabindex="-1" role="dialog" aria-labelledby="motifRefusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="motifRefusModalLabel">Motif de Refus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulaire avec une zone de texte (textarea) -->
                    <form id="motifRefusForm" method="post" action="{{route('submit.reject' , $id)}} ">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <input type="hidden" name="email" value="{{$holderWeapons->email}}">
                            <label for="motifRefusTextarea">Motif de refus :</label>
                            <textarea class="form-control" id="motifRefusTextarea" name="motif_refus" rows="4" required></textarea>
                        </div>
                        <input type="submit" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>

<script>
    var csrfToken = "{{ csrf_token() }}";

    function showConfirmationDialog(id) {
        swal({
            title: 'Ajout',
            text: 'Voulez-vous vraiment Ajouter cette fiche d\'arme ??',
            icon: 'info',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                // La route que vous souhaitez appeler
                var url = "{{ route('generate.finac', ['id' => ':id']) }}";
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if (data === 'error') {
                            console.log('error getting');
                        } else {
                            console.log(data);
                            // Redirection vers une nouvelle URL après succès
                            window.location.href = "{{ route('governor.holders.details_copy', ':id') }}".replace(':id', id);
                        }
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            } else {
                // Handle 'Cancel' case
            }
        });
    }
</script>
