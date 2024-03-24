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
        <!-- FONDO -->
        <div class="container-fluid hero-section-parallax parallax-img-1 dark-overlay">  
        </div>
        <div style="height:1000px;background-color:red;font-size:36px">
            Scroll Up and Down this page to see the parallax scrolling effect.
            This div is just here to enable scrolling.
            Tip: Try to remove the background-attachment property to remove the scrolling effect.
        </div>
            
        <div class="container-fluid hero-section-parallax parallax-img-2"></div>
    </div>
    @include("components.footer")
</body>
</html>