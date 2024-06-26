<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('components.links')
    <script type="module" src="{{ asset('js/loadCompetitionResultsAdmin.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>{{ $competition->name }}</h1>
    <h2>{{ trans("text.categories") }}</h2>
    <div class="container shadow ">
        <div class="contaier" id="results-container">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist"></div>
            </nav>
            <div class="tab-content " id="nav-tabContent"></div>
        </div>
    </div>
</div>
</body>
</html>