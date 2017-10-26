@extends('layouts.app')

@section('content')
    
    <div class="columns">
        <div class="column">
            <a href="{{route('auth.redirect',['provider' => 'google'])}}" class="button is-danger">Login Google</a>
        </div>
        <div class="column">
            <a class="button is-info">Login Twitter</a>
        </div>
        <div class="column">
            <a class="button is-link">Login Facebook</a>
        </div>
    </div>

@endsection
