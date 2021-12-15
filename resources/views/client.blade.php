<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Orquesta Vivaldi Tarija') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="/client/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/client/css/now-ui-kit.css?v=1.3.0" rel="stylesheet" />
    @routes
    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body class="landing-page sidebar-collapse">
    @inertia
    <!--   Core JS Files   -->
    <script src="/js/core/jquery.min.js"></script>
    <script src="/client/js/popper.min.js" type="text/javascript"></script>
    <script src="/client/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/client/js/now-ui-kit.js?v=1.3.0" type="text/javascript"></script>
</body>
</html>
