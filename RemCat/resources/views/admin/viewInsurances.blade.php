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
    <h1>Listado de aseguradoras</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>CIF</th>
                <th>Name</th>
                <th>Address</th>
                <th>Price</th>
                <th>Status</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($insurances as $insurance)
                <tr>
                    <td>{{$insurance->cif}}</td>
                    <td>{{$insurance->name}}</td>
                    <td>{{$insurance->address}}</td>
                    <td>{{$insurance->price}}</td>
                    <td>{{$insurance->isActive}}</td>
                    <td><a href="{{ $route }}admin/insurances/edit/{{$insurance->_id}}">Editar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>