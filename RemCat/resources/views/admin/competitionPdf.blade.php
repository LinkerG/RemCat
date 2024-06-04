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
    <h1 class="text-center">RESULTADOS DE LA COMPETICION {{ $competition->name }}</h1>
    @foreach($categories as $category => $genders)
        <h2 class="category">Categoría: {{ $category }}</p>
        @foreach($genders as $gender => $teams)
            <h3 class="gender">{{ $gender }}</h3>
            @foreach($teams as $team)
                <p class="team">Equipo: {{ $team['teamName'] }}, Tiempo: {{ $team['time'] }}</p>
            @endforeach
        @endforeach
    @endforeach
</body>
</html>
