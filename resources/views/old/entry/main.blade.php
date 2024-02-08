<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    @include('dashboard.partial.head')

    <link href="{{ asset('/assets/css/sign-in.css') }}" rel="stylesheet">

</head>

<body class="h-100">

    @include('dashboard.partial.theme')

    <div class="container-fluid">
        <div class="row">

            <!-- Main Content -->
            <main class="">
                @yield('container')
            </main>

        </div>
    </div>

    @include('dashboard.partial.script')

</body>

</html>
