@section('title','info & contact')


@section('style')
@endsection
@section('content')

    <div class="site-wrap" >

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner" style="background-color: #0F1111;">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="site-logo mr-auto w-25"><a href="{{route('home')}}"><img src="{{ asset('asset/images/cameroun-flag.png') }}" width="60" height="40" alt="Drapeau Cameroun" class="flag-icon"></a></div>

                    <div class="mx-auto text-center">
                        @guest()
                            <nav class="site-navigation position-relative navbar navbar-expand-lg text-right" role="navigation" style="background-color: #0F1111">
                                <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                                    <li><a href="{{route('home')}}" class="nav-link">Home</a></li>
                                    <li><a href="{{route('info_contact')}}" class="nav-link">Infos & Contact</a></li>
                                    <li><a href="{{route('add_armory')}}" class="nav-link">Creer une Armurerie</a></li>
                                </ul>
                            </nav>
                        @endguest
                    </div>
                    <div class="ml-auto ">
                        <nav class="site-navigation position-relative navbar navbar-expand-lg  text-right" role="navigation">
                            <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                                @auth
                                    <li class="ctav">
                                        <a href="{{route('logout')}}"  class="nav-link text-primary"><span>Logout</span>
                                        </a></li>
                                @endauth
                                @guest


                                    <li class="cta2">
                                        <a href="#" data-toggle="modal" data-target="#LoginPopupModal" class="nav-link"><span>Connexion</span>
                                        </a></li>
                                @endguest

                            </ul>
                        </nav>
                        <a href="#" class="d-inline-block-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-5" style="background-color: #0F1111">
                <div class="row">
                    <div class="col-md-6 text-light">
                        <div class="col mt-5 d-flex flex-column align-items-end"> <!-- Ajout de la classe d-flex pour activer les flexbox et flex-column pour la disposition en colonne -->
                            <div class="container mt-5">
                                <div class="col-12">
                                    <div class="text-container">
                                        <h1 data-aos="fade-up" data-aos-delay="100" style="font-family: 'Arial', sans-serif; letter-spacing: 2px; line-height: 1.2; margin-bottom: 10px;">FICHIER NATIONALE DES ARMES CIVILES.</h1>
                                        <h2 data-aos="fade-up" class="mt-5" data-aos-delay="200" style="font-family: 'Arial', sans-serif; letter-spacing: 1px; line-height: 1.2;">Ministere de L'Administration  Territoriale et de la  Decentralisation</h2>
                                    </div>
                                    @guest
                                        <div class="row mt-5">
                                                <div class="cta3">
                                                    <a href="" data-toggle="modal" data-target="#LoginLossPopupModal" class="nav-link">
                                                        <span>Déclaration de perte d'arme</span>
                                                    </a>
                                                </div>
                                            <div class="cta4">
                                                <a href="{{ route('declaration.WeaponsDeclaration') }}" class="nav-link">
                                                    <span>Déclaration de possesion d'Arme</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>
                    <div class="col-md-6">
                        <img src="{{asset('asset/images/logo_finac.jpg')}}" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
            <div>
            </div>
            <div class="container" style="background-color: #0F1111">
                <div class="row text-center">
                    <div class="col-md-12 mt-3 mb-0">
                        <p>
                            Copyright &copy;<script> 2023 ;</script> by <a href="#">SOS Home</a> All Rights Reserved
                        </p>
                    </div>
                </div>
            </div>

        </header>

        <div class="modal fade" id="LoginLossPopupModal" tabindex="-1" role="dialog" aria-labelledby="LoginLossPopupModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="LoginLossPopupModalTitle">Connexion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('verifylogin.store') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="code_finac">Code Finac <span class="text-danger">*</span></label>
                                <input type="text" name="code_finac" class="form-control" placeholder="Code Finac" autocomplete="Code Finac" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="serial_number">Numero de Serie <span class="text-danger">*</span></label>
                                <input type="text" name="serial_number" class="form-control" placeholder="Entrer votre Numero de Serie"  required>
                            </div>
                            <div class="btn-box pt-3 pb-4">
                                <input type="submit" value="Connexion" class="btn btn-primary w-100">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section bg-light"  id="contact-section">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <h2 class="section-title mb-3">Contact Us</h2>
                        <p class="mb-5">Natus totam voluptatibus animi aspernatur ducimus quas obcaecati mollitia quibusdam temporibus culpa dolore molestias blanditiis consequuntur sunt nisi.</p>

                        <form method="post" data-aos="fade">
                            <div class="form-group row">
                                <div class="col-md-6 mb-3 mb-lg-0">
                                    <input type="text" class="form-control" placeholder="First name">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Last name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Subject">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea class="form-control" id="" cols="30" rows="10" placeholder="Write your message here."></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">

                                    <input type="submit" class="btn btn-primary py-3 px-5 btn-block btn-pill" value="Send Message">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer-section bg-white">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-md-4">
                        <h3>À propos de FINAC</h3>
                        <p>FINAC est une plateforme de gestion d'armureries conçue pour faciliter la gestion et le suivi des armes et équipements. Notre solution offre des fonctionnalités avancées pour les armureries, y compris la gestion des types d'armes, des fiches d'armes, des préfectures, des gouvernorats, et bien plus encore.</p>
                    </div>

                    <div class="col-md-4">
                        <h3>Subscribe</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt incidunt iure iusto architecto? Numquam, natus?</p>
                        <form action="#" class="footer-subscribe">
                            <div class="d-flex mb-5">
                                <input type="text" class="form-control rounded-0" placeholder="Email">
                                <input type="submit" class="btn btn-primary rounded-0" value="Subscribe">
                            </div>
                        </form>
                    </div>

                </div>

                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <div class="border-top pt-5">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved by <a href="" target="_blank" >SOS Home</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </div>

@endsection
