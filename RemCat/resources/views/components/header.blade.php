<header class="container-fluid bg-primary p-2 d-flex flex-column pb-0 px-0">
    <nav class="navbar navbar-expand-sm bg-primary">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    {{-- Con el App::getLocale() conseguimos el idioma en el que esta la pagina --}}
                    <?php $route = "/" . App::getLocale() . "/" ?>
                    {{-- La ruta de los enlaces se ha de poner con el echo $route para conservar el idioma seleccionado en la página--}}
                    <a class="navbar-brand text-light" href="<?php echo $route; ?>">RemCat 🚣</a>
                </li>
                <li class="nav-item">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="lang-es">Es</button>
                        <button type="button" class="btn btn-primary" id="lang-ca">Cat</button>
                        <button type="button" class="btn btn-primary" id="lang-en">Eng</button>
                    </div>
                </li>
            </ul>
            <div class="dropdown">
                <button type="button" id="header-dropdown-button" class="dropdown-toggle btn centered-button" data-bs-toggle="dropdown">
                    {{-- Icono animado source: https://lordicon.com/icons/system/regular/8-account --}}
                    <script src="https://cdn.lordicon.com/lordicon.js"></script>
                    <lord-icon
                        id="header-dropdown-icon"
                        src="https://cdn.lordicon.com/kthelypq.json"
                        trigger="click"
                        colors="primary:#ffffff">
                    </lord-icon>
                </button>
                <ul class="dropdown-menu">
                    @if(!session('adminAuth') && !session('teamAuth') && !session('userAuth'))
                        <li><a class="dropdown-item" href="{{$route}}login">Login</a></li>
                    @endif
                    <li><hr class="dropdown-divider"></hr></li>
                    @if(session('adminAuth'))
                    <li><p>Admin</p></li>
                        <li><a class="dropdown-item" href="{{$route}}admin/sponsors/add"> Añadir sponsor </a></li>
                        <li><a class="dropdown-item" href="{{$route}}admin/insurances/add"> Añadir aseguradora </a></li>
                        <li><a class="dropdown-item" href="{{$route}}admin/competitions/add"> Añadir competicion </a></li>
                        <li><a class="dropdown-item" href="{{$route}}admin/logout">Log out</a></li>
                    @elseif(session('userAuth'))
                        <li><p>User</p></li>
                        <li><a class="dropdown-item" href="{{$route}}myCompetitions"> Ver mis competiciones </a></li>
                        <li><a class="dropdown-item" href="{{$route}}user/logout">Log out</a></li>
                    @elseif(session('teamAuth'))
                        <li><p>Team</p></li>
                        <li><a class="dropdown-item" href="{{$route}}myCompetitions"> Ver mis competiciones </a></li>
                        <li><a class="dropdown-item" href="{{$route}}team/logout">Log out</a></li>
                    @endif
                  </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid p-2 header-gradient"></div>
</header>
