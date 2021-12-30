<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('users/assets/css/style.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            @foreach ($data as $item)
            <div class="col-md-4">

            </div>
            <div class="col-md-8"></div>
            @endforeach

        </div>
    </div>
</body>
</html>
