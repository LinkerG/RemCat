<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include("components.links")
    <link rel="stylesheet" href="{{asset('css/frontPage.css')}}">
    <script src="{{asset('js/selfWrittingText.js')}}"></script>
    <script src="{{asset('js/frontPageScripts.js')}}"></script>
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        @include("components.header")
        <div class="container-fluid hero-section-parallax parallax-img-1 dark-overlay">  
            <div class="container-fluid inside-parallax-container row">
                <div class="col-4 logo-wrapper ms-5">
                    <img src="{{asset('images/logo-white.png')}}" alt="rem cat logo" class="banner-logo">
                    <div class="textWrapper">
                        <p class="selfWrittingText h1">Companyerisme</p>
                    </div>
                </div>
                <div class="scroll-down-wrapper col-6">
                    <button id="scroll-to-competitions">IR ABAJO</button>
                </div>
            </div>
        </div>
        <div class="container-fluid hero-section-parallax parallax-img-2 dark-overlay d-flex flex-column ">
            @if(!$competitions->isEmpty())
                <h2 class="text-white z-3 " style="margin-top: 5rem !important;">{{ trans("text.competitions") }}</h2>
            @endif
            <section class="container-fluid competitionContainer competition-section inside-parallax-container" id="competition-section">
                @if(!$competitions->isEmpty())
                    @foreach($competitions as $competition)
                        <article class="flex-shrink-0 competitionItem">
                            <div class="itemInside">
                                <?php $bannerRoute = "storage/competition-banners/" . $competition->image_banner; ?>
                                <div class="competitionBanner">
                                    <img class="bg-image" src="{{asset($bannerRoute)}}" alt="{{$competition->name}} banner">
                                    <div class="overImage">
                                        <div class="competitionLocation"><img class="me-1" src="{{asset('icons/geo-alt-fill.svg')}}" alt="location"><p>{{$competition->location}}</p></div>
                                        <div class="competitionDate"><img class="me-2" src="{{asset('icons/calendar-week.svg')}}" alt="date"><p>{{$competition->date}}</p></div>
                                    </div>
                                </div>
                                <div class="competitionInfo">
                                    <h4 class="">{{$competition->name}}</h4>
                                </div>
                            </div>
                        </article>
                        {{-- TODO: Habria que poner esto ->
                            <article class="card" style="width: 18rem;">
                                <img src="{{ asset($bannerRoute) }}" class="card-img-top" alt="{{ $competition->name }} banner">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $competition->name }}</h5>
                                    <p class="card-text">Descripcion generica</p>
                                    @if($competitionDate >= $today)
                                        <a href="{{ $route }}competitions/{{$year}}/join/{{$competition->_id}}" class="btn btn-primary">{{ trans("text.joinCompetitionSingle") }}</a>
                                        @if((session('teamAuth')))
                                            <a href="{{ $route }}competitions/{{$year}}/joinMultiple/{{$competition->_id}}" class="btn btn-primary">{{ trans("text.joinCompetitionMultiple") }}</a>
                                        @endif
                                    @else
                                        <a href="{{ $route }}competitions/{{$year}}/viewResults/{{$competition->_id}}" class="btn btn-primary">{{ trans("text.viewResults") }}</a>
                                    @endif
                                </div>
                            </article>
                            --}}
                    @endforeach
                @else
                    <h2 class="text-white z-3">{{ trans("text.comingSoon") }}</h2>
                @endif
            </section>
            <button class="z-3 " id="viewAllCompetitionsButton" style="margin-bottom: 5rem !important;">{{ trans("text.allCompetitions") }}</button>
        </div>
        <div style="background-color:rgb(255, 255, 255);font-size:36px" class="parallax-serparator container-fluid ">
            <h2>{{ trans("text.ourSponsors") }}</h2>
            <section class="container-fluid overflow-auto  mt-4 mb-4">
                @foreach ($sponsors as $sponsor)
                    <?php $imgRoute = "storage/sponsors/logos/" . $sponsor->image_logo; ?>
                    <figure>
                        <img src="{{asset($imgRoute)}}" alt="logo of {{$sponsor->name}}">
                        <figcaption>{{ $sponsor->name }}</figcaption>
                    </figure>
                @endforeach
            </section>
        </div>
    </div>
    @include("components.footer")
</body>
</html>