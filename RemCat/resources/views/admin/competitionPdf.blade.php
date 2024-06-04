<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pdf</title>

    <style>

    </style>
</head>
<body>
    @foreach($categories as $category => $genders)
        <p class="category">{{ $category }}</p>
        @foreach($genders as $gender => $teams)
            <p class="gender">{{ $gender }}</p>
            @foreach($teams as $team)
                <p class="team">Equipo: {{ $team['teamName'] }}, Tiempo: {{ $team['time'] }}</p>
            @endforeach
        @endforeach
    @endforeach
</body>
</html>
