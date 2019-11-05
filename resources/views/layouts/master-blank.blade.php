<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>{{ env('APP_NAME') }} - {{ env('APP_SLOGAN') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    @include('layouts.head')
    <style>
        .danger {
            color: red;
        }
    </style>
</head>

<body>
    @yield('content')
    @include('layouts.footer-script')
</body>

</html>
