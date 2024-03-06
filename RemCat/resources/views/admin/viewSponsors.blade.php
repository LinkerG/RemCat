<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insurances</title>
    @include('components.links')
    <?php $route = "/" . App::getLocale() . "/" ?>
</head>
<body>
    @include("components.header")
    <?php if(isset($succes)) echo "SUUUUUUUUUUUU";?>
    <h1>Listado de sponsors</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>CIF</th>
                <th>Name</th>
                <th>Address</th>
                <th>Image</th>
                <th>Status</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sponsors as $sponsor)
                <tr>
                    <td>{{$sponsor->cif}}</td>
                    <td>{{$sponsor->name}}</td>
                    <td>{{$sponsor->address}}</td>
                    <td>{{$sponsor->logo}}</td>
                    <td>{{$sponsor->isActive}}</td>
                    <td><a href="{{ $route }}admin/sponsors/edit/{{$sponsor->_id}}">Editar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>