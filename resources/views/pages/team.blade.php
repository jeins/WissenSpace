@extends('layouts.app')

@section('meta-data')
    <title>Team WissenSpace</title>
    <meta name="author" content="WissenSpace Team">
    <meta name="description" content="Team di balik WissenSpace. {{trans('info.desc')}}">
@endsection

@section('content')
    <section class="hero">
        <div class="hero-body">
            <div class="container">
              <h1 class="title">
                Team WissenSpace
              </h1>

               <p>
                    (TIM-TIM)
                    Tim wissenspace tersebar di Makassar, Jakarta & Berlin.
                    Silahkan disapa kalau ketemu :P
               </p>
              <p>Juan Akbar/ kerjaan / - Foto</p>
              <p>Fauzi / kerjaan / Foto</p>
              <p>Sylvi / kerjaan / Foto</p>
              <p>Ebin / kerjaan / Foto</p>
              <p>Hilman / kerjaan / Foto</p>
            </div>

            <p>
                <a href="/tentang">Tentang</a> /
                <a href="/team">Team</a> /
                <a href="/faq">Tanya</a>
            </p>
        </div>
    </section>
@endsection
