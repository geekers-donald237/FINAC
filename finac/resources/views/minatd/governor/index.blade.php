@php
    $activeLink = 'minatd';
        $subactiveLink = 'minatd.governor'

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
                    <li class="breadcrumb-item"><a><i class="fas fa-cubes"></i>Governor</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Liste des Services gouverneur</h4>
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
                                        <th scope="col">Numero Telephone</th>
                                        <th scope="col">Region</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allGovernorServices as $index => $allGovernorService)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $allGovernorService->name }}</td>
                                            <td>{{ $allGovernorService->email }}</td>
                                            <td>{{ $allGovernorService->phone_number }}</td>
                                            <td>{{ $allGovernorService->state->name }}</td>

                                            <td>
                                                <a class="btn btn-primary btn-action mr-1" title="Details">
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


<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>
