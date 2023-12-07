@php
    $activeLink = 'prefecture';
    $subactiveLink = 'prefecture.armory'

@endphp
@extends('layouts.backend')

@section('style')
    <style>
    </style>
@endsection

@section('content')
    <div class="row justify-content-between">
        <div class="col-6 col-md-6 col-lg-6">
            <div class="card card-primary rounded-0">
                <div class="card-header">
                    <h4>
                        <span class="badge badge-danger mr-2">{{ count($allArmories) }}</span>
                        Armes Perdus
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 col-lg-6">
            <div class="card card-primary rounded-0">
                <div class="card-header">
                    <h4>
                        <span class="badge badge-danger mr-2">{{ count($allArmories) }}</span>
                        Armureries
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-primary text-white-all">
                    <li class="breadcrumb-item"><a href="{{route('prefecture.index')}}"><i class="fas fa-building"></i>Prefecture</a></li>
                    <li class="breadcrumb-item"><a ><i class="fas fa-cubes"></i>Armureries</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Liste des Armureries</h4>
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
                                        <th scope="col">Boite Postale</th>
                                        <th scope="col">Numero Telephone</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Option</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($armories as $index => $armory)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $armory->name }}</td>
                                            <td>{{ $armory->email }}</td>
                                            <td>{{ $armory->mailbox }}</td>
                                            <td>{{ $armory->phone_number }}</td>
                                            <td>
                                                @if($armory->is_delete)
                                                    <div class="badge badge-secondary">Supprimé</div>
                                                @elseif($armory->statut == 'creer')
                                                    <div class="badge badge-primary">Créé</div>
                                                @elseif($armory->statut == 'verifie')
                                                    <div class="badge badge-success">Vérifié</div>
                                                @elseif($armory->statut == 'suspendu')
                                                    <div class="badge badge-warning">Suspendu</div>
                                                @else
                                                    <div class="badge badge-danger">Inconnu</div>
                                                @endif
                                            </td>
                                            <td> <a class="btn btn-info btn-action mr-1" href="{{route('prefeture.armory.details' ,$armory->id )}}" title="Editer">
                                                    Details
                                                </a></td>
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

@endsection

<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>

