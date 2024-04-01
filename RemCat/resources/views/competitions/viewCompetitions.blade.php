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
                <article>
                    <h2>{{ $competition->name }}</h2>
                </article>
            @endforeach
        </section>
    </div>
    @include('components.footer')
</body>
</html>