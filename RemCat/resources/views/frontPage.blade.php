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
        <div class="container-fluid bg-dark hero-section">
            <div class="container-fluid over-hero row mt-0">
                <div class="logo-container col-sm-5">
                    <img src="{{asset('images/logo-white.png')}}" alt="rem cat logo" class="banner-logo">
                    <div class="textWrapper">
                        <p class="selfWrittingText h1">Companyerisme</p>
                    </div>
                </div>
                <div class="competition-container col-sm-7">
                    @if(!$competitions->isEmpty())
                        <div class="container ms-3">
                            <h2>{{ trans("text.nextCompetition") }}</h2>
                        </div>
                        <section class="container-fluid competition-section d-flex" id="competitionScroll">
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
                            @endforeach
                        </section>
                    @endif
                </div>
            </div>
        </div>
        
        @if(!$sponsors->isEmpty())
            <div class="container ms-4 mt-3 mb-5">
                <h2>{{ trans("text.ourSponsors") }}</h2>
            </div>
            <section class="container-fluid overflow-auto  mt-4 mb-4">
                @foreach ($sponsors as $sponsor)
                    <?php $imgRoute = "storage/sponsors/logos/" . $sponsor->image_logo; ?>
                    <figure>
                        <img src="{{asset($imgRoute)}}" alt="logo of {{$sponsor->name}}">
                        <figcaption>{{ $sponsor->name }}</figcaption>
                    </figure>
                @endforeach
            </section>
        @endif
    </div>
    @include("components.footer")
</body>
</html>