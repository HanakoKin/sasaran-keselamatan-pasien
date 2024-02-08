<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Dashboard Template · Bootstrap v5.3</title>

    @include('dashboard.partial.head')

    <!-- Custom css for dashboard -->
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/dashboard.css') }}" rel="stylesheet">

</head>

<body class="h-100">

    @include('dashboard.partial.header')

    @include('dashboard.partial.theme')

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            @include('dashboard.partial.sidebar')

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('container')
            </main>

        </div>
    </div>

    @include('dashboard.partial.script')
    @include('dashboard.laporan-insiden.script.dashboard')

</body>

</html>
