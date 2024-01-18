
@php
    $activeLink = 'minatd';
    $subactiveLink = 'minatd.armory'
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
                    <li class="breadcrumb-item"><a><i class="fas fa-cubes"></i>{{$armoryName}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">

        <div class="col-12 col-md-6 col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Stock D'armes</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Weapons Type</th>
                                <th>Quantity</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($weaponTypes as $index => $weaponType)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $weaponType->type }}</td>
                                    <td>{{ $weaponType->quantity }}</td>
                                    <td>{{ $weaponType->description }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Fiche D'arme</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fiche Type</th>
                                <th scope="col">Date Soumission</th>
                                <th scope="col">status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissionsPorts as $key => $value)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>Demande port</td>
                                    <td>{{ $value->date_demande }}</td>
                                    <td>
                                        @php
                                            $badgeClass = '';
                                            switch($value->statut) {
                                                case 'envoye':
                                                    $badgeClass = 'badge-warning';
                                                    break;
                                                case 'accepte':
                                                    $badgeClass = 'badge-success';
                                                    break;
                                                case 'rejete':
                                                    $badgeClass = 'badge-danger';
                                                    break;
                                                // Vous pouvez ajouter d'autres cas si nécessaire
                                            }
                                        @endphp
                                        <div class="badge {{ $badgeClass }}">{{ $value->statut }}</div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Stock Munitions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom de la munition</th>
                                <th scope="col">Type de munition</th>
                                <th scope="col">Calibre</th>
                                <th scope="col">Quantité en stock</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ammos as $key => $ammo)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $ammo->name }}</td>
                                    <td>{{ $ammo->type }}</td>
                                    <td>{{ $ammo->caliber }}</td>
                                    <td>{{ $ammo->quantity_in_stock }}</td>
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


