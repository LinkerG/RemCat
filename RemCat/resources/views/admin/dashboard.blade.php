<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('components.adminLinks')
</head>
<body id="body-pd">
    <?php $route = "/" . App::getLocale() . "/" ?>
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> 
                    <img src="{{ $logoUrl }}" id="logo-img" class="collapsed">
                </a>
                <div class="nav_list"> 
                    <a href="" data-route="admin/menu" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                    <a href="" data-route="admin/competitions" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Regatas</span> </a> 
                    {{-- <a href="" data-route="" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Equipos</span> </a>  --}}
                    <a href="" data-route="admin/insurances" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Aseguradoras</span> </a> 
                    <a href="" data-route="admin/sponsors" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Sponsors</span> </a> 
                    <a href="" data-route="admin/logout" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Salir</span> </a>
                </div>
            </div> 
        </nav>
    </div>
    <!--Container Main start-->
    <div class="iframe-container height-100 bg-light">
        <iframe id="main-iframe" src="{{ $route }}admin/menu" frameborder="0"></iframe>
    </div>
</body>
@php 
    $imageUrl = asset('images/');
@endphp
<script>
    const imageUrl = "{{ $imageUrl }}";
</script>
</html>


