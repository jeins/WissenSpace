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

    @if(!config('app.debug'))
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109067486-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-109067486-1');
        </script>
    @endif
</head>
<body>

<div class="container has-small-vm">
    <nav class="navbar">
        <div class="navbar-brand">
            <a href="/">
                <img src="/images/logo.png" alt="logo wissenspace" width="150">
            </a>

            <button class="button navbar-burger" data-target="navMenu">
                <span></span><span></span><span></span>
            </button>
        </div>

        <div class="navbar-menu has-small-vm" id="navMenu">
            <div class="navbar-end">
                <a href="/explore" class="button is-info navbar-item"> Galaksi 🌏</a>
                @if (Auth::guest())
                    <a id="show-login" class="button is-info navbar-item">Login/Daftar 🌝</a>
                    @if(config('app.debug'))
                        <a href="{{route('auth.demo')}}" class="button is-dark  navbar-item">Login Demo</a>
                    @endif
                @else
                    <a href="/kontribusi" class="button is-info navbar-item">+Kontribusi 🚀</a>
                    <a href="/profile/{{Auth::user()->name}}" class="button is-info  navbar-item">Profile 👾</a>
                    <a href="/logout" class="button is-danger navbar-item">Logout 🌛</a>
                @endif
            </div>
        </div>
    </nav>
</div>

<div class="container">
    @yield('content')

    @if (Auth::guest())
        @include('auth.login_modal')
    @endif
</div>

<footer class="has-medium-vm has-text-centered">
    <p>&copy;2017 WissenSpace 🌏🚀👾🌚🌝</p>
    <a class="has-text-grey" href="https://twitter.com/wissenspace" target="_blank">Twitter</a> /
    <a class="has-text-grey" href="https://facebook.com/wissenspace" target="_blank">Facebook</a> /
    <a class="has-text-grey" href="https://instagram.com/wissenspace" target="_blank">Instagram</a>
</footer>


{{-- Scripts --}}
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<script type="text/javascript">
    $("#show-login").click(function () {
        $(".modal.login").addClass("is-active");
    });

    $("#close-modal, .modal-background").click(function () {
        $(".modal.login").removeClass("is-active");
        return false;
    })
</script>

@yield('page_script')

</body>
</html>
