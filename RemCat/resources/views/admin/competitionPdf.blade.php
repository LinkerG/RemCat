<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pdf</title>

    <style>
        table {
            padding: 1%;
            margin-bottom: 2%;
        }
    </style>
</head>
<body>
    <h1 class="text-center">RESULTADOS DE LA COMPETICION {{ $competition->name }}</h1>
    @foreach($categories as $category => $genders)
        <h2 class="category">Categoría: {{ $category }}</h2>
        @foreach($genders as $gender => $teams)
            <h3 class="gender">{{ $gender }}</h3>
            <table>
                <tr>
                    <th>Nombre del equipo</th>
                    <th>Tiempo</th>
                </tr>
                @foreach($teams as $team)
                    <tr>
                        <td>{{ $team['teamName'] }}</td>
                        <td>{{ $team['time'] }}</td>
                    </tr>
                @endforeach
            </table>
        @endforeach
    @endforeach
</body>
</html>
