<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All competitions</title>
    @include('components.links')
    <?php $route = "/" . App::getLocale() . "/" ?>
</head>
<body>
    <div class="wrapper">
        @include('components.header')
        <section class=" ">
            @foreach ($competitions as $competition)
                <?php 
                    $bannerRoute = "storage/competition-banners/" . $competition->image_banner;
                    $today = new DateTime();
                    $competitionDate = new DateTime($competition->date)
                ?>
                <article class="card" style="width: 18rem;">
                    <img src="{{ asset($bannerRoute) }}" class="card-img-top" alt="{{ $competition->name }} banner">
                    <div class="card-body">
                        <h5 class="card-title">{{ $competition->name }}</h5>
                        <p class="card-text">Descripcion generica</p>
                        @if($competitionDate >= $today)
                            @if((session('teamAuth')))
                                <a href="{{ $route }}competitions/{{$year}}/joinMultiple/{{$competition->_id}}" class="btn btn-primary">{{ trans("text.joinCompetitionMultiple") }}</a>
                            @elseif((session('userAuth')) || ($competition->isOpen))
                                <a href="{{ $route }}competitions/{{$year}}/join/{{$competition->_id}}" class="btn btn-primary">{{ trans("text.joinCompetitionSingle") }}</a>    
                            @endif
                        @else
                            <a href="{{ $route }}competitions/{{$year}}/viewResults/{{$competition->_id}}" class="btn btn-primary">{{ trans("text.viewResults") }}</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </section>
    </div>
    @include('components.footer')
</body>
</html>