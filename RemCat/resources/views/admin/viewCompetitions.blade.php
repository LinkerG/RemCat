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
                <th>Name</th>
                <th>Location</th>
                <th>Boat Type</th>
                <th>Is OPEN?</th>
                <th>Date</th>
                <th>Map image</th>
                <th>Sponsor price</th>
                <th>Sponsor list</th>
                <th>Cancelled</th>
                <th>Status</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($competitions as $competition)
                <tr>
                    <td>{{$competition->name}}</td>
                    <td>{{$competition->location}}</td>
                    <td>{{$competition->boatType}}</td>
                    <td>{{$competition->isOpen}}</td>
                    <td>{{$competition->date}}</td>
                    <td>{{$competition->image_map}}</td>
                    <td>{{$competition->sponsor_price}}</td>
                    <td>{{$competition->sponsor_list}}</td>
                    <td>{{$competition->isCancelled}} cancelled</td>
                    <td>{{$competition->isActive}}</td>
                    <td><a href="{{ $route }}admin/competitions/edit/{{$competition->_id}}">Editar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>