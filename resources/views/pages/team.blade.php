@extends('layouts.pages')

@section('meta-data')
    <title>Team WissenSpace</title>
    <meta name="author" content="WissenSpace Team">
    <meta name="description" content="Team di balik WissenSpace. {{trans('info.desc')}}">
@endsection

@section('text')
      <h1 class="title">
        Team WissenSpace
      </h1>

       <p class="subtitle">
            Tim wissenspace tersebar di Makassar, Jakarta & Berlin.<br>
            Silahkan disapa kalau ketemu :P
       </p>

       <br>

       <div class="columns">
           <div class="column">
               <img  src="/images/team/juan.jpg" alt="foto juan akbar" width="100" >
               <div class="title is-size-5">Muh. Juan Akbar</div>
               <div class="subtitle is-size-6">Dari Pontianak </div>
               <a href='http://mjuan.info/' class="button" target="_blank">Halo!</a>
           </div>
           <div class="column">
               <img  src="/images/team/hilman.jpg" alt="foto hilman ramadhan" width="100" >
               <div class="title is-size-5">Hilman Ramadhan</div>
               <div class="subtitle is-size-6">Dari Makasssar</div>
               <a href='https://hilmanrdn.id' class="button" target="_blank">Halo!</a>
           </div>
           <div class="column">
               <img  src="/images/team/sylvi.jpg" alt="foto Sylvia Martshalina" width="100" >
               <div class="title is-size-5">Sylvia Martshalina</div>
               <div class="subtitle is-size-6">Dari Jakarta</div>
               <a href='https://instagram.com/sylviamartshalina/' class="button" target="_blank">Halo!</a>
           </div>
       </div>

       <div class="columns">
           <div class="column">
               <img  src="/images/team/ebin.jpg" alt="foto Ebin Aridansyah" width="100" >
               <div class="title is-size-5">Ebin Ardiansyah</div>
               <div class="subtitle is-size-6">Dari Anambas</div>
               <a href='https://www.instagram.com/ebinardian/' class="button" target="_blank">Halo!</a>
           </div>
           <div class="column">
               <img  src="/images/team/fauzi.jpg" alt="foto Fauzi Arif Senjaya" width="100" >
               <div class="title is-size-5">Fauzi Arif Sanjaya</div>
               <div class="subtitle is-size-6">Dari Tasik</div>
               <a href='http://fauzias.me/' class="button" target="_blank">Halo!</a>
           </div>
           <div class="column">

           </div>
       </div>
@endsection
