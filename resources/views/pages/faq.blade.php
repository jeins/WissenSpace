@extends('layouts.app')

@section('meta-data')
    <title>FAQ WissenSpace</title>
    <meta name="author" content="WissenSpace Team">
    <meta name="description" content="Yang sering ditanyakan di WissenSpace. {{trans('info.desc')}}">
@endsection

@section('content')
    <section class="hero">
        <div class="hero-body">
            <div class="container">
              <h1 class="title">
                FAQ WissenSpace
              </h1>
              <h2 class="subtitle">
                  Yang sering ditanyakan
              </h2>

              <p>WissenSpace apa sih?</p>
              <p>Baca halaman ini ya! <a href="/tentang">Tentang</a> :D</p>

              <p>Siapa aja yang boleh kontribusi?</p>
              <p>Yang mau lihat Indonesia dan dunia jadi lebih baik</p>

              <p>Siapa tim pembuat wissenspace?</p>
              <p>Ada di halaman  <a href="/team">Team</a> :D</p>

              <hr>

              <p>Apakah perlu daftar?</p>
              <p>Ngga perlu, cukup login dengan socialmedia atau gmail kamu</p>

              <p>Bagaimana cara kontribusi?</p>
              <p>Setelah login, masuk ke halaman <a href='kontribusi'>Kontribusi</a> dan masukkan keterangan-keterangannya</p>

              <p>Apa saja link yang boleh dimasukkan?</p>
              <p>Pada dasarnya semuanya, channel atau video youtube, bacaan artikel, aplikasi web ataupun mobile juga boleh</p>

              <hr>

              <p>Kenapa perlu wissenspace?</p>
              <p>Ada banyak link yang tersebar, bayangin kalau kita bisa memudahkan langkah teman kita, ngerjar cita-citanya, walaupun itu cuman satu langkah,
              bibit manfaat yang kita tanam sekarang, pohonnya bisa ngelindungin banyak orang dan menghasilkan bibit bibit berikutnya!</p>

            </div>
            <p>
                <a href="/tentang">Tentang</a> /
                <a href="/team">Team</a> /
                <a href="/faq">Tanya</a>
            </p>
        </div>
    </section>
@endsection
