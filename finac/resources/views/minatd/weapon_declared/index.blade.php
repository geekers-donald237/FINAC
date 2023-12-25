@php
    $activeLink = 'minatd';
    $subactiveLink = 'minatd.weapon_declared'

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
                    <li class="breadcrumb-item"><a href="{{route('minatd.index')}}"><i class="fas fa-building"></i>Minatd</a></li>
                    <li class="breadcrumb-item"><a><i class="fas fa-cubes"></i>Arme Declarees</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Liste des Arme declaree</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">type de l'arme</th>
                                <th scope="col">Numero de serie</th>
                                <th scope="col">Date de declaration possesion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($declaredArm as $index => $arm)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $arm['weapon_type'] }}</td>
                                    <td>{{ $arm['serial_number'] }}</td>
                                    <td>{{ $arm['created_at'] }}</td>
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
