@extends('admin.layouts.app ')

@section('content')

    <div class="container is-widescreen">
        <form role="form" method="POST" action="{{ route('admin.login.submit') }}">
            {{ csrf_field() }}

            <div class="field">
                <p class="control has-icons-left has-icons-right">
                    <input class="input" name="email" type="email" placeholder="Email">
                </p>
            </div>
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" name="password" type="password" placeholder="Password">
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <button type="submit" class="button is-success">
                        Login
                    </button>
                </p>
            </div>
        </form>

    </div>
@endsection