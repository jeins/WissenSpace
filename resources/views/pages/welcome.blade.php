@extends('layouts.app')
@section('content')
    <section class="hero">
        <div class="hero-body">
            <div class="container">
              <h1 class="title">
                WissenSpace
              </h1>
              <h2 class="subtitle">
                Belajar hal baru setiap hari
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
