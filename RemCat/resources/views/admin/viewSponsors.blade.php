<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insurances</title>
    @include('components.links')
    <?php $route = "/" . App::getLocale() . "/" ?>
    <script src="{{asset('js/toggleActive.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <?php if(isset($succes)) echo "SUUUUUUUUUUUU";?>
    <h1>Listado de sponsors</h1>
    <a type="button" class="btn btn-primary rounded" href="{{$route}}admin.competitio">Añadir sponsor</a>
    <table class="table table-striped" data-model="sponsors">
        <thead>
            <tr>
                <th>CIF</th>
                <th>Name</th>
                <th>Address</th>
                <th>Image</th>
                <th>Active</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sponsors as $sponsor)
                <tr>
                    <td>{{$sponsor->cif}}</td>
                    <td>{{$sponsor->name}}</td>
                    <td>{{$sponsor->address}}</td>
                    <td></td>
                    @if($sponsor->isActive)
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-active" type="checkbox" id="{{$sponsor->_id}}_toggle" value="yes" checked>
                        </div>
                    </td>
                    @else
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-active" type="checkbox" id="{{$sponsor->_id}}_toggle" value="yes">
                        </div>
                    </td>
                    @endif
                    <td><a href="{{ $route }}admin/sponsors/edit/{{$sponsor->_id}}">Editar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
