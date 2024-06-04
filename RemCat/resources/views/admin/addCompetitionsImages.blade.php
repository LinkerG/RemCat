<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add insurance</title>
    <?php $route = "/" . App::getLocale() . "/" ?>
    @include('components.adminLinks')
    <script src="{{ asset('js/dragAndDrop.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/dragAndDrop.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <section>
        <form id="upload-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Arrastra las imágenes</label>
                            <div class="dropzone-wrapper">
                                <div class="dropzone-desc">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                    <p>Arrastra tus fotos aquí.</p>
                                </div>
                                <input type="file" name="images[]" class="dropzone" multiple>
                            </div>
                            <div class="preview-zone hidden">
                                <div class="box box-solid">
                                    <div class="box-header with-border p-4">
                                        <div><b>Visualizar</b></div>
                                    </div>
                                    <div class="box-body d-flex"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Subir fotos</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <a class="btn btn-primary btn btn-block w-47 rounded" href="{{$route}}admin/competitions" type="button">Volver atrás</a>
</body>
</html>
