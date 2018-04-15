<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MTBBS') - 梦途科技内部论坛</title>
    <meta name="description" content="@yield('description','MTBBS')" />
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" class="{{ route_class() }}-page">

        <div id="wrapper">
            <div class="overlay">
            </div>
            @include('layouts._header',['categories'=> \App\Models\Category::all()])
        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="container">
            @include('layouts._message')
            @yield('content')
            </div>
        </div>
            @include('layouts._footer')
        </div>
    </div>
    @if (app()->isLocal())
        @include('sudosu::user-selector')
    @endif

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>