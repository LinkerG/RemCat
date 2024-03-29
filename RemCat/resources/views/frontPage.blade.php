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
            <div class="container inside-parallax-container row">
                <div class="col-4 logo-wrapper">
                    <img src="{{asset('images/logo-white.png')}}" alt="rem cat logo" class="banner-logo">
                    <div class="textWrapper">
                        <p class="selfWrittingText h1">Companyerisme</p>
                    </div>
                </div>
            </div>
        </div>
        <div style="background-color:rgb(255, 255, 255);font-size:36px" class="parallax-serparator container-fluid ">
            <h2>{{ trans("text.beforeCompetitions") }}</h2>
        </div>
        <div class="container-fluid hero-section-parallax parallax-img-2 dark-overlay">
            <div class="container inside-parallax-container">
                
            </div>
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