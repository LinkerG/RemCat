<!DOCTYPE html>
<html lang="en">
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
    @include("components.footer")
</body>
</html>