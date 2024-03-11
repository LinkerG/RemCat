<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insurances</title>
    @include('components.links')
    <?php $route = "/" . App::getLocale() . "/" ?>
    <script src="{{asset('js/toggleActive.js')}}"></script>
    <script src="{{asset('js/toggleCancelled.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @include("components.header")
    <?php if(isset($succes)) echo "SUUUUUUUUUUUU";?>
    <div class="container d-flex">
        <h1 class="me-4">Listado de competiciones</h1>
        <div class="input-group mt-3 mb-3">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
              Select year
            </button>
            <ul class="dropdown-menu">
                @foreach ($years as $yearOption)
                        <li><a href="{{$route}}admin/competitions/{{$yearOption}}"> {{str_replace('_', '-', $yearOption);}} </a></li>
                @endforeach
            </ul>
          </div>
    </div>
    <table class="table table-striped" data-model="competitions" data-year="{{$year}}">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Boat Type</th>
                <th>OPEN / PRO</th>
                <th>Date</th>
                <th>Map image</th>
                <th>Sponsor price</th>
                <th>Sponsor list</th>
                <th>Cancelled</th>
                <th>Status</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($competitions as $competition)
                <tr>
                    <td>{{$competition->name}}</td>
                    <td>{{$competition->location}}</td>
                    @if($competition->boatType == 'llaut_med')
                    <td>
                        Llaüt {{trans("text.mediterraneo")}}
                    </td>
                    @elseif($competition->boatType == 'batel')
                        <td>
                            Batel
                        </td>
                    @elseif($competition->boatType == 'llagut_cat')
                        </td>
                            Llagut català
                        <td>
                    @else
                        <td>
                            Unknown boat type
                        </td>
                    @endif
                    @if($competition->isOpen)
                    <td>
                        OPEN
                    </td>
                    @else
                    <td>
                        PRO
                    </td>
                    @endif
                    <td>{{$competition->date}}</td>
                    <td>{{$competition->image_map}}</td>
                    <td>{{$competition->sponsor_price}}</td>
                    @if($competition->sponsors_list === "[]")
                    <td>
                        empty
                    </td>
                    @else
                    <td>
                        not empty
                    </td>
                    @endif
                    @if($competition->isCancelled)
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-cancelled" type="checkbox" id="{{$competition->_id}}_cancelled" value="yes" checked>
                        </div>
                    </td>
                    @else
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-cancelled" type="checkbox" id="{{$competition->_id}}_cancelled" value="yes">
                        </div>
                    </td>
                    @endif
                    @if($competition->isActive)
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-active" type="checkbox" id="{{$competition->_id}}_toggle" value="yes" checked>
                        </div>
                    </td>
                    @else
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-active" type="checkbox" id="{{$competition->_id}}_toggle" value="yes">
                        </div>
                    </td>
                    @endif
                    <td><a href="{{ $route }}admin/competitions/edit/{{$year}}/{{$competition->_id}}">Editar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>