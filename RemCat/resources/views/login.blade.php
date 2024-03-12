<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include("components.links")
    <script src="{{ asset('js/formValidator.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    <title>RemCat - Login</title>
    <?php $route = "/" . App::getLocale() . "/" ?>
</head>
<body>
    @include("components.header")
    {{--  TODO: Añadir el atributo NAME a los inputs  --}}
    {{--  Si no no se puede hacer el manejo del POST  --}}
    <form action="{{$route}}login" method="post" enctype="multipart/form-data">
      @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="email" name="email" placeholder="" value="" required>
            <label for="name">{{ trans('admin.form.email') }}</label>
            <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="" value="" required>
            <label for="name">{{ trans('admin.form.password') }}</label>
            <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
        </div>
        
        <button type="button" id="submit-button" class="btn btn-primary">Log in</button>
        <button type="button" id="switch-button" class="btn btn-primary">Sign up</button>
        
    </form>
</body>
</html>