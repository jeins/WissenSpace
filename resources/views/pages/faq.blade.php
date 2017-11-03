@extends('layouts.pages')

@section('meta-data')
    <title>FAQ WissenSpace</title>
    <meta name="author" content="WissenSpace Team">
    <meta name="description" content="Yang sering ditanyakan WissenSpace. {{trans('info.desc')}}">
@endsection

@section('text')
    <h1 class="title">
      FAQ WissenSpace
    </h1>
    <h2 class="subtitle">
        Yang sering ditanyakan
    </h2>

    <div class="has-small-vm">
        <p class="title is-size-5">WissenSpace apa sih?</p>
        <p class="subtitle is-size-6">Baca halaman ini ya! <a href="/tentang">Tentang Wissenspace</a> :D</p>
    </div>

    <div class="has-small-vm">
        <p class="title is-size-5">Siapa aja yang boleh kontribusi?</p>
        <p class="subtitle is-size-6">Yang mau lihat Indonesia dan dunia jadi lebih baik</p>
    </div>

    <div class="has-small-vm">
        <p class="title is-size-5">Siapa tim pembuat wissenspace?</p>
        <p class="subtitle is-size-6">Ada di halaman  <a href="/team">Team</a> :D</p>
    </div>
    <hr>

    <div class="has-small-vm">
        <p class="title is-size-5">Apakah perlu daftar?</p>
        <p class="subtitle is-size-6">Ngga perlu, cukup login dengan socialmedia atau gmail kamu</p>
    </div>

    <div class="has-small-vm">
        <p class="title is-size-5">Bagaimana cara kontribusi?</p>
        <p class="subtitle is-size-6">Setelah login, masuk ke halaman <a href='kontribusi'>Kontribusi</a> dan masukkan keterangan-keterangannya</p>
    </div>

    <div class="has-small-vm">
        <p class="title is-size-5">Apa saja link yang boleh dimasukkan?</p>
        <p class="subtitle is-size-6">Pada dasarnya semuanya, channel atau video youtube, bacaan artikel, aplikasi web ataupun mobile juga boleh. Selama bermanfaat</p>
    </div>
    <hr>

    <div class="has-small-vm">
        <p class="title is-size-5">Kenapa perlu wissenspace?</p>
        <p class="subtitle is-size-6">Ada banyak link yang tersebar, bayangin kalau kita bisa memudahkan langkah teman kita, ngerjar cita-citanya, walaupun itu cuman satu langkah,
        bibit manfaat yang kita tanam sekarang, pohonnya bisa ngelindungin banyak orang dan menghasilkan bibit bibit berikutnya!</p>
    </div>

    <h1 class="title is-size-5">Ada Saran atau Pertanyaan?</h1>
    <div id="disqus_thread">
    </div>
    <script>

    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://wissenspace.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

@endsection
