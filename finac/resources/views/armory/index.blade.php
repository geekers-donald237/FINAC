@php
    $activeLink = 'armory';
        $subactiveLink = 'dashboard';

@endphp
@extends('layouts.backend')

@section('content')
    <div class="row">
        @forelse($weaponTypes as $weaponType)
            <div class="col-4 col-md-3 col-lg-3">
                <div class="card card-primary rounded-0">
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
                <div class="card card-primary rounded-0">
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
                    <li class="breadcrumb-item"><a href="{{route('armory.index')}}"><i class="fas fa-building"></i>Armueries</a></li>
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-cubes"></i>Fiche D'armes</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-auto">
            <nav aria-label="breadcrumb">
                <a class="btn btn-success btn-pilll" href="{{route('add_arm_sheet')}}">
                    Ajouter une fiche d'arme
                </a>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Fiche D'armes en cours de Validation</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <div class="card-body">
                                <table class="table">
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
                                                        case 'valide':
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

                                            <!-- Ajoutez d'autres colonnes en fonction de vos besoins -->
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
<script></script>
