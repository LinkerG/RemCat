<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Info</title>
    @include('components.links')
</head>
<body>
    @include('components.header')
    <div class="container shadow mt-4 p-5">
        <div class="row">
            <div class="col-12">
                <h2>{{ $competition->name }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-7 bg-black p1 text-white " >
                {{ $competition->image_map }}
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="col-12">
                        {{ $competition->location }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $competition->date }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $competition->boatType }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>{{ trans("text.results") }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="contaier shadow">
                    a
                </div>
            </div>
        </div>
    </div>
</body>
</html>