@php
    $activeLink = 'user';
  $subactiveLink = 'user.armory'
@endphp
@extends('layouts.backend')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-primary text-white-all">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-building"></i>Creer une armurerie/ </a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card  card-primary">
                <div class="card-header">
                    <h4>Armurerie</h4>
                </div>
                <form action="{{ route('armory.store') }}" id="form" method="POST" style="width: 100%" enctype="multipart/form-data" class="needs-validation" novalidate="">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col">
                                <label for="nom">Nom<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Nom de l'armurerie" name="name" required>
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

                        <div class="row">
                            <div class="form-group col">
                                <label for="secteur">Nom gerant<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="manager_name" placeholder="nom gerant" required>
                            </div>

                            <div class="form-group col">
                                <label for="adresse">Adresse<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" placeholder="Adresse" required>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col">
                                <label for="license">License de creation <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="license" accept = ".pdf" placeholder="License" required>
                            </div>

                            <div class="form-group col">
                                <label for="id_state">Departement<span class="text-danger">*</span></label>
                                <select type="2" class="form-control select2" id="departement_id"
                                        name="departement_id" required>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info"
                                onclick="showLoader(); this.disabled=true; this.innerHTML='<i class=\'fas fa-spinner fa-spin\'></i> Envoi en cours...'">
                            Ajouter</button>
                    </div>
                </form>
            </div>


        </div>
    </div>


@endsection

<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>

<script>
    // Fonction pour afficher le loader
    function showLoader() {
        // Afficher le loader
        $('#form').submit();
        $('#loader-wrapper').show();
    }

    // Attacher une fonction de gestionnaire d'événements pour masquer le loader lorsque la page est prête
    $(window).on('load', function () {
        hideLoader();
    });

    // Fonction pour masquer le loader
    function hideLoader() {
        $('#loader-wrapper').hide();
    }
</script>
