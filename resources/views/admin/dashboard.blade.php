@extends('admin.layouts.app')

@section('content')
    <h1>Hallo Admin</h1>
    @if (Auth::guard('admin')->check())
        <a href="{{ route('admin.logout') }}">Logout</a>
    @endif
@endsection
