<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include("components.links")
    <link rel="stylesheet" href="{{asset('css/frontPage.css')}}">
    <script src="{{asset('js/selfWrittingText.js')}}"></script>
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        @include("components.header")
        <div class="container-fluid bg-dark banner-container">
            <div class="container over-banner">
                <img src="{{asset('images/logo-white.png')}}" alt="rem cat logo" class="banner-logo">
                <div class="textWrapper">
                    <p class="selfWrittingText h1"></p>
                </div>
            </div>
        </div>
        @if(!$competitions->isEmpty())
            <div class="container ms-4 mt-3 mb-5">
                <h2>{{ trans("text.nextCompetition") }}</h2>
            </div>
        @endif
        <section class="container-fluid overflow-auto competitionSection mt-4 mb-4">
            <div class="d-inline-flex flex-row flex-nowrap overflow-auto competitionContainer">
                @if(($competitions))
                    @foreach($competitions as $competition)
                        <article class="flex-shrink-0 competitionItem">
                            <div class="itemInside">
                                <?php $bannerRoute = "images/competitionBanners/" . $competition->image_banner; ?>
                                <img class="competitionBanner" src="{{asset($bannerRoute)}}" alt="{{$competition->name}} banner">
                                <div class="competitionInfo">
                                    <h4 class="">{{$competition->name}}</h4>
                                    <p class="competitionLocation">{{$competition->location}}</p>
                                    <p class="competitionDate">{{$competition->date}}</p>
                                    <a href="#" class="">Card link</a>
                                    <a href="#" class="">Another link</a>
                                </div>
                            </div>
                        </article>
                        <article class="flex-shrink-0 competitionItem">
                            <div class="itemInside">
                                <?php $bannerRoute = "images/competitionBanners/" . $competition->image_banner; ?>
                                <img class="competitionBanner" src="{{asset($bannerRoute)}}" alt="{{$competition->name}} banner">
                                <div class="competitionInfo">
                                    <h4 class="">{{$competition->name}}</h4>
                                    <p class="competitionLocation">{{$competition->location}}</p>
                                    <p class="competitionDate">{{$competition->date}}</p>
                                    <a href="#" class="">Card link</a>
                                    <a href="#" class="">Another link</a>
                                </div>
                            </div>
                        </article>
                        <article class="flex-shrink-0 competitionItem">
                            <div class="itemInside">
                                <?php $bannerRoute = "images/competitionBanners/" . $competition->image_banner; ?>
                                <img class="competitionBanner" src="{{asset($bannerRoute)}}" alt="{{$competition->name}} banner">
                                <div class="competitionInfo">
                                    <h4 class="">{{$competition->name}}</h4>
                                    <p class="competitionLocation">{{$competition->location}}</p>
                                    <p class="competitionDate">{{$competition->date}}</p>
                                    <a href="#" class="">Card link</a>
                                    <a href="#" class="">Another link</a>
                                </div>
                            </div>
                        </article>
                        <article class="flex-shrink-0 competitionItem">
                            <div class="itemInside">
                                <?php $bannerRoute = "images/competitionBanners/" . $competition->image_banner; ?>
                                <img class="competitionBanner" src="{{asset($bannerRoute)}}" alt="{{$competition->name}} banner">
                                <div class="competitionInfo">
                                    <h4 class="">{{$competition->name}}</h4>
                                    <p class="competitionLocation">{{$competition->location}}</p>
                                    <p class="competitionDate">{{$competition->date}}</p>
                                    <a href="#" class="">Card link</a>
                                    <a href="#" class="">Another link</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @else
                    <h1>No hay</h1>
                @endif
            </div>
        </section>
    </div>
    @include("components.footer")
</body>
</html>