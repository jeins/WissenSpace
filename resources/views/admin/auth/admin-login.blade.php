@extends('admin.layouts.app ')
@section('css')
    <style>
        html, body {
            font-family: 'Open Sans', serif;
            font-size: 14px;
            font-weight: 300;
        }

        .hero.is-success {
            background: #F2F6FA;
        }

        .hero .nav, .hero.is-success .nav {
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .box {
            margin-top: 5rem;
        }

        .avatar {
            margin-top: -70px;
            padding-bottom: 20px;
        }

        .avatar img {
            padding: 5px;
            background: #fff;
            border-radius: 50%;
            -webkit-box-shadow: 0 2px 3px rgba(10, 10, 10, .1), 0 0 0 1px rgba(10, 10, 10, .1);
            box-shadow: 0 2px 3px rgba(10, 10, 10, .1), 0 0 0 1px rgba(10, 10, 10, .1);
        }

        input {
            font-weight: 300;
        }

        p {
            font-weight: 700;
        }

        p.subtitle {
            padding-top: 1rem;
        }
    </style>
@endsection

@section('content')

    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <div class="box">
                        <figure class="avatar">
                            <img src="https://placehold.it/128x128">
                        </figure>
                        <form role="form" method="POST" action="{{ route('admin.login.submit') }}">
                            {{ csrf_field() }}

                            <div class="field">
                                <div class="control">
                                    <input class="input" name="email" type="email" placeholder="Email" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input" name="password" type="password" placeholder="Password">
                                </div>
                            </div>
                            <button type="submit" class="button is-info is-large" style="width: 100%;">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection