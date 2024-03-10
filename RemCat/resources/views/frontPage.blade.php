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
        @if(($competitions))
            @foreach($competitions as $competition)
                <article>
                    <h2>{{$competition->name}}</h2>
                    <h3>{{$competition->location}}</h3>
                </article>
            @endforeach
        @else
            <h1>No hay</h1>
        @endif
    </section>
    @include("components.footer")
</body>
</html>