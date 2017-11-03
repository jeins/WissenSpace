@extends('layouts.app')

@section('meta-data')
    <title>{{trans('info.title')}}</title>
    <meta name="author" content="WissenSpace Team">
    <meta name="description" content="{{trans('info.desc')}}">
    <!-- twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="wissenspace">
    <meta name="twitter:creator" content="WissenSpace Team">
    <meta name="twitter:title" content="{{trans('info.title')}}">
    <meta name="twitter:url" content="https://wissenspace.com">
    <meta name="twitter:description" content="{{trans('info.desc')}}">
    <meta name="twitter:image:src" content="/images/logo.png">
    <!-- facebook -->
    <meta property="og:title" content="{{trans('info.title')}}" />
    <meta property="og:description" content="{{trans('info.desc')}}">
    <meta property="og:image" content="/images/logo.png">
@endsection

@section('content')

    <div class="notification notif-greeting is-warning">
        <div class="columns">
            <div class="column">
                <span class="is-size-5">Hey! Salam kenal dan Selamat datang!</span>
            </div>
        </div>
    </div>

    <section class="hero is-ws-grey has-small-vm is-landing-page">
        <div class="hero-body">
            <div class="container">
              <h1 class="title is-3">
                WissenSpace - Belajar hal baru setiap hari
              </h1>
              <h2 class="subtitle is-4">
                Punya referensi belajar menarik? Share linknya di wissenspace!
              </h2>
              <a class="button home-contribute">Pasang Link</a>
              <a href='/explore' class="button">Lihat-Lihat</a>
            </div>
        </div>
    </section>

    <div class="columns">
        <div class="column">
            <div class="panel">
                <h3 class="panel-heading is-blue">Referensi terramai</h3>
                @foreach ($top_products as $top_product)
                    <a class="panel-block" href="explore/{{$top_product->slug}}">{{$top_product->name}}</a>
                @endforeach
            </div>
        </div>

        <div class="column">
            <div class="panel">
                <h3 class="panel-heading is-blue">Referensi terbaru</h3>
                @foreach ($new_products as $new_product)
                    <a class="panel-block" href="explore/{{$new_product->slug}}">{{$new_product->name}}</a>
                @endforeach
            </div>
        </div>
    </div>

@endsection
@section('page_script')
    <script type="text/javascript">
        @if (Auth::guest())
            $('.home-contribute').attr('onClick', '$(".modal.login").addClass("is-active")');
        @else
            $('.home-contribute').attr('href', '{{route("contribute")}}');
        @endif

        $('.notif-greeting').delay(1000).fadeOut(2500);
    </script>
@endsection
