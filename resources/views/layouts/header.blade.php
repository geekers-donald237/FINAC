<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
    @if (session()->has('sucess_register'))
        <div class="container-fluid">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong class="text-center" >{{session('sucess_register')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="container-fluid">

        <div class="d-flex align-items-center">

            <div class="site-logo mr-auto w-25"><a href="index.html">FINAC</a></div>
            <div class="mx-auto text-center">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                        <li><a href="#home-section" class="nav-link">Home</a></li>
                        <li><a href="#courses-section" class="nav-link">Services</a></li>
                        <li><a href="#programs-section" class="nav-link">Atouts</a></li>
                        <li><a href="#contact-section" class="nav-link">Contactez-nous</a></li>
                    </ul>
                </nav>
            </div>

            <div class="ml-auto w-25">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                        @auth
                            <li class="ctav">
                                <a href="{{route('logout')}}"  class="nav-link text-primary"><span>Logout</span>
                                </a></li>
                        @endauth
                        @guest
                                <li class="cta">
                                    <a href="#" data-toggle="modal" data-target="#RegisterPopupModal" class="nav-link"><span>Creer un Compte</span>
                                    </a></li>

                                <li class="cta2">
                                    <a href="#" data-toggle="modal" data-target="#LoginPopupModal" class="nav-link"><span>Connexion</span>
                                    </a></li>
                        @endguest

                    </ul>
                </nav>
                <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
            </div>
        </div>
    </div>

</header>
