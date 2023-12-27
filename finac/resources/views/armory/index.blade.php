@php
    $activeLink = 'armory';
        $subactiveLink = 'dashboard';

@endphp
@extends('layouts.backend')

@section('content')
    <div class="row">
        @forelse($weaponTypes as $weaponType)
            <div class="col-4 col-md-3 col-lg-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>
                            <span class="badge badge-danger mr-2">{{ $weaponType->quantity }}</span>
                            {{ $weaponType->type }}
                        </h4>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-10 col-md-10 col-lg-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>
                            <span class="badge badge-danger mr-2"></span>
                            Aucun Type d'arme enregistree
                        </h4>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="row justify-content-between">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-primary text-white-all">
                    <li class="breadcrumb-item"><a href="{{route('armory.index')}}"><i class="fas fa-building"></i>Armueries</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-cubes"></i>Fiche client</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-4 text-right">
            <button type="button" class="btn btn-primary" href="{{route('add_arm_sheet')}}">
                Ajouter une fiche client
            </button>
        </div>


    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Ma Fiche Client</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type D'armes</th>
                                <th scope="col">Numero de serie</th>
                                <th scope="col">Proprietaire</th>
                                <th scope="col">Date vente</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($permissionsPorts as $key => $value)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $value->weapon->weaponType->type }}</td>
                                    <td>{{ $value->weapon->serial_number }}</td>
                                    <td>{{ $value->weapon->holder->fullname ?? 'nnn' }}</td>
                                    <td> {{$value->date_demande}}
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
@endsection
<script></script>
