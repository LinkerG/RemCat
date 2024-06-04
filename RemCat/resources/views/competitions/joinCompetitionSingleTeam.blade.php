<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Single team</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://www.paypal.com/sdk/js?client-id=AZJld8gcAnjfOhAt7qo3EgdvyVMHLoyF6T727CeyU-yXmuSCrzzVq4hdnSvr_iAnI29fAkG7H0VB1C-a&currency=EUR"></script>
    <script src="{{ asset('js/joinCompetitionSingle.js')}}"></script>
    @include('components.links')
</head>
<body>
    @include('components.header')
    <div class="container shadow mt-4 p-5">
        @include('competitions.forms.singleTeam')
    </div>
</body>
</html>
