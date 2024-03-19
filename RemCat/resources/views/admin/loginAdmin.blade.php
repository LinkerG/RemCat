<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include("components.links")
    <title>Admin</title>
    <?php $route = "/" . App::getLocale() . "/" ?>
</head>
<body>
    {{--  TODO: Añadir el atributo NAME a los inputs  --}}
    {{--  Si no no se puede hacer el manejo del POST  --}}
    <form action="{{$route}}admin" method="post" enctype="multipart/form-data">
      @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>