<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Info</title>
    @include('components.links')
    <script src="{{ asset("js/loadCompetitionResults.js") }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">   
    <?php $route = "/" . App::getLocale() . "/" ?>
    <style>
        .image-custom{
            max-width: 20rem;
            object-fit: contain;
            aspect-ratio: 1/1;
        }
    </style>
</head>
<body>
    @include('components.header')
    <div class="container shadow mt-4 p-5">
        <div class="row">
            <div class="col-12">
                <h2>{{ $competition->name }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-7 p1 " >
                {{ $competition->image_map }}
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="col-12">
                        {{ $competition->location }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $competition->date }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $competition->boatType }}
                    </div>
                </div>
            </div>
        </div>
        <div>
            @if((session('teamAuth') && !$competition->isOpen))
                <a href="{{ $route }}competitions/{{$year}}/joinMultiple/{{$competition->_id}}" class="btn btn-primary">{{ trans("text.joinCompetitionMultiple") }}</a>
            @elseif ((session('userAuth') || session('teamAuth')) && $competition->isOpen)
                <a href="{{ $route }}competitions/{{$year}}/join/{{$competition->_id}}" class="btn btn-primary">{{ trans("text.joinCompetitionSingle") }}</a>    
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <h2>{{ trans("text.results") }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="contaier" id="results-container">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist"></div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <h2>Sponsors de esta competicion</h2>
            <section class="container-fluid overflow-auto d-flex mt-4 mb-4">
                @foreach ($sponsors as $sponsor)
                        <p class="m-5">{{ $sponsor->name }}</p>
                @endforeach
            </section>
        </div>
        <div class="row">
            <h2>Fotos</h2>
            <section class="container-fluid d-flex mt-4 mb-4 flex-wrap">
                @foreach ($competition->images as $image)
                    <?php $imgRoute = './storage/competition-images/' . $image ?>
                        <img 
                        class="m-2 image-custom"
                        src="{{ asset($imgRoute) }}" 
                        alt="a">
                @endforeach
            </section>
        </div>
    </div>
</body>
</html>