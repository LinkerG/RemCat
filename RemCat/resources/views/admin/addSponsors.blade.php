<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add sponsors</title>
    @include('components.links')
</head>
<body>
    @include('components.header')
    <?php

// Obtén el idioma de la sesión
$idioma = App::currentLocale(); // Si la sesión no está establecida, se usa 'es' como idioma por defecto

// Imprime el idioma
echo "El idioma actual es: $idioma";

?>
    <div class="container shadow mt-5 p-5">
        <h1 class="mb-3">{{ trans('admin.sponsor.title') }}</h1>
        <form action="#" method="post">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingCif">
                <label for="floatingCif">CIF</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingName">
                <label for="floatingName">{{ trans('admin.sponsor.name') }}</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingAddress">
                <label for="floatingAddress">{{ trans('admin.sponsor.address') }}</label>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">{{ trans('admin.sponsor.image') }}</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <button class="btn btn-primary" type="submit">{{ trans('admin.addButton') }}</button>
        </form>
    </div>
</body>
</html>