<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="/css/nucleo-svg.css" rel="stylesheet" />

    <link rel="stylesheet" href="/css/flatpickr.css">
    <!-- CSS Files -->
    <link href="/css/soft-ui-dashboard.css?v=1.0.2" rel="stylesheet" />
    <link href="/css/btn-dark.css" rel="stylesheet" />
    <link href="/css/btn-dim.css" rel="stylesheet" />
    <link href="/css/btn-gray.css" rel="stylesheet" />
    <link href="/css/btn-red.css" rel="stylesheet" />
    <link href="/css/btn-sienna.css" rel="stylesheet" />
    <link href="/css/btn-state.css" rel="stylesheet" />
    <link href="/css/btn-cafe.css" rel="stylesheet" />
    <link href="/css/circle-color.css" rel="stylesheet" />
    <link href="/css/vue-multiselect.css" rel="stylesheet" />

    <style>
    body {
        overflow-x: hidden;
    }
</style>

@routes
<script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body class="g-sidenav-show bg-gray-100">
    @inertia
    <!--   Core JS Files   -->
    <script src="/js/core/jquery.min.js"></script>
    <script src="/js/core/popper.min.js"></script>
    <script src="/js/core/bootstrap.min.js"></script>
    <script src="/js/plugins/jquery.dataTables.min.js"></script>
    <script src="/js/plugins/bootstrap-notify.js"></script>
    <script src="/js/soft-ui-dashboard.min.js?v=1.0.2"></script>
</body>
</html>