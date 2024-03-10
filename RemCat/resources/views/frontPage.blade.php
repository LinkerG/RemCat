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
    @include("components.header")
    <div class="container-fluid bg-dark banner-container">
        <div class="container over-banner">
            <img src="{{asset('images/logo-white.png')}}" alt="rem cat logo" class="banner-logo">
            <div class="textWrapper">
                <p class="selfWrittingText h1"></p>
            </div>
        </div>
    </div>
    <section class="container">
        <div class="d-inline-flex flex-row flex-nowrap overflow-auto ">
            @if(($competitions))
                @foreach($competitions as $competition)
                    <article class="flex-shrink-0 me-2">
                        <div class="">
                            <h4 class="">{{$competition->name}}</h4>
                            <p class="">{{$competition->location}} - {{$competition->date}}</p>
                            <a href="#" class="">Card link</a>
                            <a href="#" class="">Another link</a>
                        </div>
                    </article>
                    <article class="flex-shrink-0 me-2">
                        <div class="">
                            <h4 class="">{{$competition->name}}</h4>
                            <p class="">{{$competition->location}} - {{$competition->date}}</p>
                            <a href="#" class="">Card link</a>
                            <a href="#" class="">Another link</a>
                        </div>
                    </article>
                    <article class="flex-shrink-0 me-2">
                        <div class="">
                            <h4 class="">{{$competition->name}}</h4>
                            <p class="">{{$competition->location}} - {{$competition->date}}</p>
                            <a href="#" class="">Card link</a>
                            <a href="#" class="">Another link</a>
                        </div>
                    </article>
                    <article class="flex-shrink-0 me-2">
                        <div class="">
                            <h4 class="">{{$competition->name}}</h4>
                            <p class="">{{$competition->location}} - {{$competition->date}}</p>
                            <a href="#" class="">Card link</a>
                            <a href="#" class="">Another link</a>
                        </div>
                    </article>
                    <article class="flex-shrink-0 me-2">
                        <div class="">
                            <h4 class="">{{$competition->name}}</h4>
                            <p class="">{{$competition->location}} - {{$competition->date}}</p>
                            <a href="#" class="">Card link</a>
                            <a href="#" class="">Another link</a>
                        </div>
                    </article>
                @endforeach
            @else
                <h1>No hay</h1>
            @endif
        </div>
    </section>
    @include("components.footer")
</body>
</html>