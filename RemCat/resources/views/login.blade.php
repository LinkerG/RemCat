<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include("components.links")
    <script src="{{ asset('js/login.js') }}"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AZJld8gcAnjfOhAt7qo3EgdvyVMHLoyF6T727CeyU-yXmuSCrzzVq4hdnSvr_iAnI29fAkG7H0VB1C-a&currency=EUR"></script>
    <title>RemCat - Login</title>
    <?php $route = "/" . App::getLocale() . "/" ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">   
</head>
<body>
    <div class="wrapper loginWrapper">
        <div class="formWrapper">
            <h1 class="loginLabel">Login</h1>
            <form action="{{ $route }}login" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="" value="{{ old('email')}}" autofocus>
                    <label for="email">Email</label>
                    @error('email') 
                    <div class="invalid-feedback" style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror    
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="" value="">
                    <label for="password">{{ trans('admin.form.password') }}</label>
                    @error('password') 
                    <div class="invalid-feedback" style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror 
                </div>
                <button type="submit" id="login-submit-button" class="btn btn-primary">Log in</button>
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