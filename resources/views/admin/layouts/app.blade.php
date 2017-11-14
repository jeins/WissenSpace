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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.1/css/bulma.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('css')

    {{-- Scripts --}}
    @yield('head')

</head>
<body>
<div id="app">
    @if (Auth::guard('admin')->check())
        <header class="hero is-light">
            <div class="hero-head">
                <nav class="navbar has-shadow" role="navigation" aria-label="main navigation">
                    <div class="navbar-brand">
                        <a class="navbar-item">WS Administrator</a>
                    </div>
                    <div class="navbar-menu navbar-end" id="navMenu">
                        <a class="navbar-item is-right" href="{{ route('admin.logout') }}">Logout</a>
                    </div>
                </nav>
            </div>
        </header>

        <div class="section">
            <div class="columns">
                <aside class="column is-2">
                    @include('admin.layouts.nav')
                </aside>

                <main class="column">
                    @yield('content')
                </main>
            </div>
        </div>
    @else
        @yield('content')
    @endif
</div>

{{-- Scripts --}}
<script src="{{ asset('js/app.js') }}"></script>
@yield('script')

</body>
</html>