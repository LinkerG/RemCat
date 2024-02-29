<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add sponsors</title>
    @include('components.links')
</head>
<body>
    @include('components.header')
    <div class="container shadow mt-5 p-5">
        <h1 class="mb-3">Añadir sponsor</h1>
        <form action="#" method="post">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingCif">
                <label for="floatingCif">CIF</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingName">
                <label for="floatingName">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingAddress">
                <label for="floatingAddress">Address</label>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Sponsor logo image</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
    </div>
</body>
</html>