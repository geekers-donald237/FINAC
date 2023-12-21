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
                    <li class="breadcrumb-item"><a href="{{route('minatd.index')}}"><i class="fas fa-building"></i>Admin</a></li>
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
                                <th scope="col">type de l'arme</th>
                                <th scope="col">Numero de serie</th>
                                <th scope="col">Date de Perte</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lostWeapons as $index => $declaration)
                                {{$declaration}}
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $declaration->weapon_type }}</td>
                                    <td>{{ $declaration->serial_number }}</td>
                                    <td>{{ $declaration->date }}</td>
                                    <td>
                                        {{-- Ajoutez ici vos liens ou boutons d'options --}}
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

<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>
