@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="hero-body">
            <div class="container columns">
                <div class="column is-two-thirds">
                    @yield('text')
                 </div>

                 <div class="column">
                     <ul class="panel">
                        <li class="panel-block"> <a href="/tentang">Tentang</a> </li>
                        <li class="panel-block"> <a href="/team">Team</a> </li>
                        <li class="panel-block"> <a href="/faq">Tanya</a> </li>
                        <li class="panel-block"> <a href="/faq#disqus_thread">Feedback</a> </li>
                     </ul>
                 </div>
            </div>
        </div>
    </section>
@endsection
