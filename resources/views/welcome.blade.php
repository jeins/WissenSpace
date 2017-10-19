@extends('layouts.app')
@section('content')
    <section class="hero">
        <div class="hero-body">
            <div class="container">
               <img src="/images/logo.png" alt="wissenspace logo" style="width: 150px; margin: 0 10px;">
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
        <div class="container">
            <div class="column">
                @if (Auth::guest())
                    <a href="{{route('auth.redirect',['provider' => 'google'])}}" class="button is-danger">Login Google</a>
                @endif
                <a href='explore' class="button is-info">Explore</a>
            </div>
        </div>
    </div>

@endsection
