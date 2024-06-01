<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include("components.links")
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script type="module" src="{{asset('js/qrGenerator.js')}}"></script>
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        @include("components.header")
        <div class="flex flex-wrap" id="qr-container" data-competitions="{{ $competitions }}">

        </div>
    </div>
    @include("components.footer")
</body>
</html>
