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
    <section class="hero">
        <div class="hero-body">
            <div class="container">
              <h1 class="title">
                WissenSpace - Belajar hal baru setiap hari
              </h1>
              <h2 class="subtitle">
                Punya referensi belajar menarik? yuk share di wissenspace!
              </h2>
            </div>
        </div>
    </section>

    <div class="section">
        <h3>Popular Product</h3>
        @foreach ($top_products as $top_product)
            <li><a href="explore/{{$top_product->slug}}">{{$top_product->name}}</a></li>
        @endforeach

        <h3>New Product</h3>
        @foreach ($new_products as $new_product)
            <li><a href="explore/{{$new_product->slug}}">{{$new_product->name}}</a></li>
        @endforeach
    </div>

@endsection
