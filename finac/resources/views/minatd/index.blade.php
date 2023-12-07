@php
    $activeLink = 'minatd';
    $subactiveLink = 'minatd.fiche'

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
                    <li class="breadcrumb-item"><a href=""><i class="fas fa-building"></i>Minatd</a></li>
                    <li class="breadcrumb-item"><a ><i class="fas fa-cubes"></i>Fiche d'armes</a></li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="row justify-content-between">
        <div class="col-4 col-md-3 col-lg-3">
            <div class="card card-primary rounded-0">
                <div class="card-header">
                    <h4>
                        <span class="badge badge-danger mr-2">{{$permissionsValides}}</span>
                        fiche validee
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-3 col-lg-3">
            <div class="card card-primary rounded-0">
                <div class="card-header">
                    <h4>
                        <span class="badge badge-danger mr-2">{{$permissionsRejetees}}</span>
                        Fiche Refuse
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-3 col-lg-3">
            <div class="card card-primary rounded-0">
                <div class="card-header">
                    <h4>
                        <span class="badge badge-danger mr-2">{{$permissionsNonTraitees}}</span>
                        Fiche non consulte
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Liste des Fiche d'armes non valide</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom demandeur</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Profession</th>
                                        <th scope="col">Destinateur</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($associatedData as $key=> $data)

                                        <tr>
                                            <th scope="row">{{ intval($key) + 1 }}</th>
                                            <td>{{ $data['holderWeapons']->fullname }}</td>
                                            <td>{{ $data['holderWeapons']->telephone }}</td>
                                            <td>{{ $data['holderWeapons']->email }}</td>
                                            <td>{{ $data['holderWeapons']->profession }}</td>
                                            <td>{{$data['weapon']->weaponType->armory->name}}</td>
                                            <td>
                                                <a class="btn btn-primary btn-action" href="{{route('holders.details', $data['permissionsPortId'])}}" title="Details">
                                                    Details
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

@endsection
