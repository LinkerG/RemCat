<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include("components.links")
    <title>Admin</title>
</head>
<body>
  @include("components.header")
    {{--  TODO: Añadir el atributo NAME a los inputs  --}}
    {{--  Si no no se puede hacer el manejo del POST  --}}
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          @csrf
          <label for="exampleInputEmail1">Email address</label>
          <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
          @error ('email') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          @error ('password') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>