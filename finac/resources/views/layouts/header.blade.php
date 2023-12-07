<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner" style="background-color: skyblue;">
<div class="container-fluid">
        <div class="d-flex align-items-center">
            <div class="site-logo mr-auto w-25"><a href="{{route('home')}}"><img src="{{ asset('asset/images/cameroun-flag.png') }}" width="60" height="40" alt="Drapeau Cameroun" class="flag-icon"></a></div>

            <div class="mx-auto text-center">
                @guest()
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                            <li><a href="{{route('home')}}" class="nav-link">Home</a></li>
                            <li><a href="{{route('info_contact')}}" class="nav-link">Infos & Contact</a></li>
                            <li><a href="{{route('add_armory')}}" class="nav-link">Creer une Armurerie</a></li>
                        </ul>
                    </nav>
                @endguest
            </div>

            <div class="ml-auto ">
                <nav class="site-navigation position-relative text-right" role="navigation">
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

</header>


