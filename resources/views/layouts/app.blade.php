<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta-data')

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

    <div class="container has-small-vm">
        <nav class="level">
            <div class="level-left">
                <a href="/">
                    <img src="/images/logo.png" alt="logo wissenspace" width="150">
                </a>
            </div>

            <div class="level-right">
                <a href="/explore" class="button is-info level-item"> Galaksi 🌏</a>
                <a href="/kontribusi" class="button is-info  level-item">+Kontribusi 🚀</a>
                @if (Auth::guest())
                    <a href="/login" class="button is-info  level-item">Login/Daftar 🌝</a>
                    @if(config('app.debug'))
                        <a href="{{route('auth.demo')}}" class="button is-dark  level-item">Login Demo</a>
                    @endif
                    @else
                    <a href="/profile/{{Auth::user()->name}}" class="button is-info  level-item">Profile 👾</a>
                    <a href="/logout" class="button is-danger level-item">Logout 🌛</a>
                @endif
            </div>
        </nav>
    </div>

    <div class="container">
        @yield('content')
    </div>

    <footer class="has-small-vm has-text-centered">
        <p>&copy;2017 WissenSpace 🌏🚀👾🌚🌝</p>
        <a class="has-text-grey" href="https://twitter.com/wissenspace" target="_blank">Twitter</a> /
        <a class="has-text-grey" href="https://facebook.com/wissenspace" target="_blank">Facebook</a> /
        <a class="has-text-grey" href="https://instagram.com/wissenspace" target="_blank">Instagram</a>
    </footer>


{{-- Scripts --}}
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@yield('page_script')

</body>
</html>
