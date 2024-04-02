<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All competitions</title>
    @include('components.links')
</head>
<body>
    <div class="wrapper">
        @include('components.header')
        <section class=" ">
            @foreach ($competitions as $competition)
                <article class="card" style="width: 18rem;">
                    <?php $bannerRoute = "storage/competition-banners/" . $competition->image_banner; ?>
                    <img src="{{ asset($bannerRoute) }}" class="card-img-top" alt="{{ $competition->name }} banner">
                    <div class="card-body">
                        <h5 class="card-title">{{ $competition->name }}</h5>
                        <p class="card-text"></p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        <a href="#" class="btn btn-primary">Go somewhere else</a>
                    </div>
                </article>
            @endforeach
        </section>
    </div>
    @include('components.footer')
</body>
</html>