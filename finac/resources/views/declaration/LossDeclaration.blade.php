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
                    <li class="breadcrumb-item"><a ><i class="fas fa-cubes"></i>Pertes D'armes</a></li>
                </ol>
            </nav>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-body">

                    <form action="{{route('declaration.store')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="form-group col">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            </div>

                            <div class="form-group col">
                                <label for="surname">Surname <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="dateNaissance">Date de Naissance <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" placeholder="Date de Naissance" required>
                            </div>

                            <div class="form-group col">
                                <label for="lieuNaissance">Lieu de Naissance<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lieuNaissance" name="lieuNaissance" placeholder="Lieu de Naissance" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="photoRecto">Photo Recto<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="photoRecto" name="photoRecto" placeholder="Photo Recto" required>
                            </div>

                            <div class="form-group col">
                                <label for="photoVerso">Photo Verso<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="photoVerso" name="photoVerso" placeholder="Photo Verso" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="date">Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
                            </div>

                            <div class="form-group col">
                                <label for="adresse">adresse<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="adresse" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description<span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Description" required></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Declarer comme perdu</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@endsection
