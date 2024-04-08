<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add insurance</title>
    @include('components.links')
    <script src="{{asset('js/formValidator.js')}}"></script>
    <script src="{{asset('js/sponsorSelectorPopup.js')}}"></script>
    <script src="{{asset('js/imagePreview.js')}}"></script>
    <style>
    </style>
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
    <div class="container shadow mt-4 mr-5 ml-5 p-5">
        <h1 class="" style="text-align: center">{{ trans('admin.competition.title') }}</h1>
        <form action="#" method="post" class="mt-1" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="row">
                        <div class="col-12 my-2">
                            <div class="form-floating ">
                                <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{old('name')}}" required>
                                <label for="name">{{ trans('admin.form.name') }}</label>
                                <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
                            </div>
                        </div>
                        <div class="col-12 my-2">
                            <div class="form-floating">
                                <select class="form-select" id="boatType" name="boatType">
                                    <option value="llaut_med">Llaüt {{ trans('text.mediterraneo') }}</option>
                                    <option value="batel">Batel</option>
                                    <option value="llagut_cat">Llagut català</option>
                                </select>
                                <label for="boatType" class="form-label">{{ trans('admin.competition.boatType') }}</label>
                            </div>
                        </div>
                        <div class="col-12 my-2">
                            <div class="form-floating ">
                                <input type="text" class="form-control" id="address" name="address" placeholder="" value="{{old('address')}}" required>
                                <label for="address">{{ trans('admin.competition.location') }}</label>
                                <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
                            </div>
                        </div>
                        <div class="col-12 my-2 mb-0">
                            <div class="form-floating ">
                                <input type="number" class="form-control" id="price" name="price" placeholder="" value="{{old('price')}}">
                                <label for="price">{{ trans('admin.competition.price') }} - €</label>
                                <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
                            </div>
                        </div>
                        <div class="col-12 my-2">
                            <div class="w-100 ">
                                <label for="competition-date" class="form-label ms-2 mt-2 mb-0">{{ trans('admin.form.date') }}</label>
                                <input class="form-control" type="date" id="competition-date" name="competition-date">
                            </div>
                        </div>
                        <div class="col-12 my-2">
                            <div class="input-group input-group-lg  ">
                                <div class="input-group-text">
                                    <input type="checkbox" name="isOpen">
                                </div>
                                <input type="text" class="form-control" value="{{ trans('admin.competition.isOpen') }} (esto hay que centrarlo)" disabled >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="row mh-75 h-75 ">
                        <div class="my-2 d-flex justify-content-center align-items-center ">
                            <img src="" alt="preview of map" id="preview-map">
                        </div>
                    </div>
                    <div class="row h-25 ">
                        <div class="d-flex flex-column justify-content-end mb-2">
                            <label for="image-map" class="form-label ms-2 mt-2">{{ trans('admin.competition.image') }}</label>
                            <input class="form-control" type="file" id="image-map" name="image-map">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="row mh-75 h-75 ">
                        <div class="my-2 d-flex justify-content-center align-items-center ">
                            <img src="" alt="preview of banner" id="preview-banner">
                        </div>
                    </div>
                    <div class="row h-25 ">
                        <div class="d-flex flex-column justify-content-end mb-2">
                            <label for="image-banner" class="form-label ms-2 mt-2">{{ trans('admin.competition.banner') }}</label>
                            <input class="form-control" type="file" id="image-banner" name="image-banner">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-12 col-md-4">
                    <div class="col-12 my-2">
                        <div class=" d-grid">
                            <button class="btn btn-secondary btn btn-block" id="openAddSponsors" type="button" data-bs-toggle="modal" data-bs-target="#sponsorList">
                                {{ trans('admin.competition.addSponsorList') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="col-12 my-2">
                        <div class="d-flex justify-content-between ">
                            <button class="btn btn-success btn btn-block w-47" id="submit-button" type="button">{{ trans('admin.addButton') }}</button>
                            <button class="btn btn-primary btn btn-block w-47" type="button">{{ trans('admin.backButton') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <input type="hidden" name="sponsors-list" id="sponsors-list" style="display: none;" value="[]">
        </form>
    </div>
    <div class="modal fade" id="sponsorList">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('admin.competition.sponsorList') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="spinner-border"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="addSponsorsToList"> {{ trans('admin.addButton') }} </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>