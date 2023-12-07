@extends('layouts.template')

@section('content')

    <div class="site-wrap">
        <div class="intro-section" id="home-section">
            <div class="slide-1" style="background-image: url('{{ asset('asset/images/normal.jpg') }}'); opacity: 1 " data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="row  align-items-center">
                                <h1 data-aos="fade-up" data-aos-delay="100">Fichier National des Armes Civile</h1>
                                <h2 data-aos="fade-up" data-aos-delay="100">MINISTERE DE L'ADMINISTRATION TERRITORIALE ET DE LA DECENTRALISATION</h2>
{{--                                <p class="mb-4" data-aos="fade-up" data-aos-delay="200">Controle - Gestion - Securisation - Tracabilite.</br></p>--}}

                            </div>
                            @guest
                             <div class="row">
                                 <li class="cta3">
                                     <a href="{{ route('declaration.LossDeclaration') }}" class="nav-link">
                                         <span>Déclaration de Pertes</span>
                                     </a>
                                 </li>
                                 <li class="cta4">
                                     <a href="{{ route('declaration.WeaponsDeclaration') }}" class="nav-link ">
                                         <span>Déclaration d'Arme</span>
                                     </a>
                                 </li>
                             </div>

                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
         </div>



@endsection
