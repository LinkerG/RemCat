<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insurances</title>
    @include('components.adminLinks')
    <?php $route = "/" . App::getLocale() . "/" ?>
    <script src="{{asset('js/toggleActive.js')}}"></script>
    <script src="{{asset('js/toggleCancelled.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <?php if(isset($succes)) echo "SUUUUUUUUUUUU";?>
    <div class="container-fluid d-flex align-items-center">
        <h1>Listado de competiciones</h1>
        <div class="filtros ms-auto d-flex align-items-center">
            <div class="input-group">
                <a type="button" class="btn btn-primary rounded" href="{{$route}}admin/competitions/add">Añadir competicion</a>
                <button type="button" class="btn btn-primary dropdown-toggle mx-5 rounded" data-bs-toggle="dropdown">
                  Select year
                </button>
                <ul class="dropdown-menu">
                    @foreach ($years as $yearOption)
                            <li><a href="{{$route}}admin/competitions/{{$yearOption}}"> {{str_replace('_', '-', $yearOption);}} </a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <table class="table table-striped" data-model="competitions" data-year="{{$year}}">
        <thead style="border-top: 1px solid black">
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Boat Type</th>
                <th>O/P</th>
                <th>Date</th>
                <th class="text-center">Sponsors</th>
                <th class="text-center">Start competition</th>
                <th class="text-center">Cancelled</th>
                <th class="text-center">Status</th>
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
                    <td>{{$competition->sponsor_price}}</td>
                    <?php
                    $today = new DateTime();
                    $competitionDate = new DateTime($competition->date);
                    $today = $today->format('Y-m-d');
                    $competitionDate = $competitionDate->format('Y-m-d');
                    ?>
                    @if($competitionDate == $today)
                        <td>
                            <a href="{{ $route }}admin/competitions/info/{{$year}}/{{$competition->_id}}">
                                <button data-id="{{ $competition->_id }}" class="btn btn-primary px-5 start-competition">Start</button>
                            </a>
                        </td>
                    @else
                        <td>
                            <div class="d-flex align-items-center justify-content-center ">
                                <button data-id="{{ $competition->_id }}" class="btn btn-primary px-5 start-competition" disabled>Start</button>
                            </div>
                        </td>
                    @endif
                    @if($competition->isCancelled)
                        <td>
                            <div class="form-check form-switch d-flex align-items-center justify-content-center ">
                                <input class="form-check-input toggle-cancelled" type="checkbox" id="{{$competition->_id}}_cancelled" value="yes" checked>
                            </div>
                        </td>
                    @else
                        <td>
                            <div class="form-check form-switch d-flex align-items-center justify-content-center ">
                                <input class="form-check-input toggle-cancelled" type="checkbox" id="{{$competition->_id}}_cancelled" value="yes">
                            </div>
                        </td>
                    @endif
                    @if($competition->isActive)
                        <td>
                            <div class="form-check form-switch d-flex align-items-center justify-content-center ">
                                <input class="form-check-input toggle-active" type="checkbox" id="{{$competition->_id}}_toggle" value="yes" checked>
                            </div>
                        </td>
                    @else
                        <td>
                            <div class="form-check form-switch d-flex align-items-center justify-content-center ">
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
