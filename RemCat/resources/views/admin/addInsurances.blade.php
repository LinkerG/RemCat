<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add insurance</title>
    @include('components.links')
    <script src="{{asset('js/formValidator.js')}}"></script>
</head>
<body>
    @include('components.header')
    @if(!$errors->isEmpty())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container container-small shadow mt-4 mr-5 ml-5 p-5">
        <h1 class="mb-3" style="text-align: center">{{ trans('admin.insurance.title') }}</h1>
        <form action="#" method="POST" class="mt-1">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="cif" name="cif" placeholder="" value="{{old('cif')}}" required>
                <label for="cif">CIF</label>
                <div class="invalid-feedback ms-2">CIf no valido</div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{old('name')}}" required>
                <label for="name">{{ trans('admin.form.name') }}</label>
                <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="address" name="address" placeholder="" value="{{old('address')}}" required>
                <label for="address">{{ trans('admin.form.address') }}</label>
                <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="price" name="price" placeholder="" value="{{old('price')}}">
                <label for="price">{{ trans('admin.insurance.price') }} - €</label>
                <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
            </div>
            <div class="mt-5 flex-row-reverse " style="display: flex">
                <button class="btn btn-success btn-lg fix-size" id="submit-button" type="button">{{ trans('admin.addButton') }}</button>
                <button class="btn btn-primary btn-lg fix-size me-3" type="button">{{ trans('admin.backButton') }}</button>
            </div>
        </form>
    </div>
</body>
</html>