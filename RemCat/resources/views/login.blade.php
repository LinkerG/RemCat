<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include("components.links")
    <script src="{{ asset('js/login.js') }}"></script>
    <title>RemCat - Login</title>
    <?php $route = "/" . App::getLocale() . "/" ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">   
</head>
<body>
    <div class="wrapper loginWrapper">
        <div class="formWrapper">
            <h1 class="loginLabel">Login</h1>
            <form action="{{$route}}login" method="post" enctype="multipart/form-data">
              @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{ old('email')}}" autofocus>
                    <label for="email">Email</label>
                    @error('email') {{ $message }} @enderror    
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="" value="">
                    <label for="password">{{ trans('admin.form.password') }}</label>
                    @error('password') {{ $message }} @enderror 
                </div>
                
                <button type="button" id="login-submit-button" class="btn btn-primary">Log in</button>
                <hr>
                <p class="align-center">or</p>
                <hr>
                <button type="button" id="switch-button" class="btn btn-primary">Sign up</button>
            </form>
        </div>
        <div class="footerFixedWrapper">
            @include("components.footer")
        </div>
    </div>
</body>
</html>