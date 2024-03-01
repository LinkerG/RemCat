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
    <div class="container container-small shadow mt-4 mr-5 ml-5 p-5">
        <h1 class="mb-3" style="text-align: center">{{ trans('admin.sponsor.title') }}</h1>
        <form action="#" method="post" class="mt-1">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingCif" placeholder="">
                <label for="floatingCif">CIF</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingName" placeholder="">
                <label for="floatingName">{{ trans('admin.form.name') }}</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingAddress" placeholder="">
                <label for="floatingAddress">{{ trans('admin.form.address') }}</label>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label ms-2">{{ trans('admin.sponsor.image') }}</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="mt-5 flex-row-reverse " style="display: flex">
                <button class="btn btn-success btn-lg fix-size" type="submit">{{ trans('admin.addButton') }}</button>
                <button class="btn btn-primary btn-lg fix-size me-3" type="submit">{{ trans('admin.backButton') }}</button>
            </div>
        </form>
    </div>
</body>
</html>