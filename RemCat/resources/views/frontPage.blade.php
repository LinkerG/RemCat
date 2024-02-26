<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/headerCustom.css')}}">
    <link rel="stylesheet" href="{{asset('css/frontPage.css')}}">
    <script src="{{asset('js/selfWrittingText.js')}}"></script>
    <title>Document</title>
</head>
<body>
    @include("components.header")
    <div class="container-fluid bg-dark banner-container" style="display: flex; flex-direction:column">
        <img src="{{asset('images/banner.png')}}" alt="banner image" class="img-fluid banner-image">
        <div class="container over-banner">
            <img src="{{asset('images/logo-white.png')}}" alt="rem cat logo" class="banner-logo">
            <div class="textWrapper">
                <p class="selfWrittingText display-3"></p>
            </div>
        </div>
        <div class="mask">
        </div>
    </div>
    @include("components.footer")
</body>
</html>