@php
    $activeLink = 'minatd';
    $subactiveLink = 'minatd.weapon_lost'

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
                    <li class="breadcrumb-item"><a href="{{route('minatd.index')}}"><i class="fas fa-building"></i>Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a><i class="fas fa-cubes"></i>Prefecture</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Liste des Arme declarre perdue</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom Propriétaire</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Type d'arme</th>
                                <th scope="col">Numéro de série</th>
                                <th scope="col">Date Declaration</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lostWeapons as $index => $weapon)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $weapon->holder->fullname  }}</td>
                                    <td>{{ $weapon->holder->telephone  }}</td>
                                    <td>{{ $weapon->weaponType->type  }}</td>
                                    <td>{{ $weapon->serial_number  }}</td>
                                    <td>{{ $weapon->created_at  }}</td>
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

<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>
