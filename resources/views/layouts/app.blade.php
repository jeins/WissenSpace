<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WissenSpace Dev</title>
    <meta name="description" content="WissenSpace Dev">

    {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{-- Styles --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('page_css')

    {{-- Scripts --}}
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>

</head>
<body>
<div id="app">
    <nav>
        <a href="/">
            <img src="/images/logo.png" alt="logo wissenspace" width="150">
        </a>
        <a href="/explore" class="button is-primary"> Galaksi</a>
        <a href="/kontribusi" class="button is-primary">+ Kontribusi</a>
        @if (Auth::guest())
            <a href="/login" class="button is-info">Login/Daftar</a>
        @else
            <a href="/logout" class="button is-danger">Logout</a>
        @endif
    </nav>

    <div class="container">
        @yield('content')
    </div>

</div>

{{-- Scripts --}}
<script src="{{ asset('js/app.js') }}"></script>
@yield('page_script')

</body>
</html>
