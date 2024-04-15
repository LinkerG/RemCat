<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Multiple team</title>
    @include('components.links')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/multiTeamScripts.js') }}"></script>
</head>
<body>
    @include('components.header')
    <div class="container shadow mt-4 p-5">
        @include('competitions.forms.multipleTeam')
    </div>
    <div class="alert-container d-none"></div>
</body>
</html>