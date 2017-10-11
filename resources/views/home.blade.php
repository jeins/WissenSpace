@extends('layouts.app')

@section('content')
    @if (Auth::guest())
        <h1>Hallo Guest</h1>
    @else
        <h1>Hallo {{ Auth::user()->full_name }}</h1>
    @endif
@endsection
