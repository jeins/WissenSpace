@extends('layouts.app')

@section('meta-data')
    <title>Explore {{trans('info.title')}}</title>
    <meta name="author" content="WissenSpace Team">
    <meta name="description" content="Referensi belajar terbaru di wissenspace. {{trans('info.desc')}}">
    <!-- twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="wissenspace">
    <meta name="twitter:creator" content="WissenSpace Team">
    <meta name="twitter:title" content="Explore {{trans('info.title')}}">
    <meta name="twitter:url" content="https://wissenspace.com">
    <meta name="twitter:description" content="Referensi belajar terbaru di wissenspace. {{trans('info.desc')}}">
    <meta name="twitter:image:src" content="/images/logo.png">
    <!-- facebook -->
    <meta property="og:title" content="Explore {{trans('info.title')}}" />
    <meta property="og:description" content="Referensi belajar terbaru di wissenspace. {{trans('info.desc')}}">
    <meta property="og:image" content="/images/logo.png">
@endsection

@section('content')
    <div class="columns has-medium-vm">
      <div class="column is-one-quarter is-hidden-touch">
            <div>
                <h3 class="is-size-5 has-text-weight-semibold">Planet</h3>
                <ul>
                    @foreach ($tags as $tag)
                        <li>
                            <a class="has-text-grey" href="/explore/planet/{{$tag->name}}"> #{{$tag->name}} </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="has-small-vm">
                <h3 class="is-size-5 has-text-weight-semibold">Media</h3>
                <ul>
                    @foreach ($types as $type)
                        <li>
                            <a class="has-text-grey" href="/explore/media/{{$type->name}}"> {{$type->name}} </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="has-small-vm">
                <h3 class="is-size-5 has-text-weight-semibold">WissenSpace</h3>
                <a class="has-text-grey"  href="/tentang">Tentang</a> /
                <a class="has-text-grey" href="/team">Team</a> /
                <a class="has-text-grey" href="/faq">Tanya</a>
            </div>
        </div>

        <div class="column">
            @foreach ($products->take(10) as $product)
                <a href='/explore/{{$product->slug}}' class="products products-link media"  data-id="{{$product->id}}">
                    <img class="media-left" src="{{$product->thumbnail}}" width="100">
                    <div class="media-content">
                        <h3 class="title is-size-5 is-capitalized">{{ $product->name }}</h3>
                        <p class="subtitle is-size-6">{{ $product->tagline }}</p>
                        <div class="level">
                            <div class="level-left">
                                @foreach ($product->tags as $tag)
                                    <span class="level-item tag">#{{$tag->name}}</span>
                                @endforeach
                            </div>
                            <div class="level-right">
                                <div class="tags">
                                    <span class="tag">
                                        <span class="icon is-small">
                                          <i class="fa fa-comment"></i>
                                        </span>
                                        <span>{{$product->comments_count}}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

            <!-- loadmore  -->
            @if($products->count() > 10)
              <a class="button is-primary load-more is-fullwidth has-small-vm">Explore Lagi</a>
            @endif
        </div>

        <div class="column is-one-quarter has-text-centered is-hidden-touch">
            <div class="notification is-primary">
                <div class="title is-size-4">Halo!</div>
                 <div class="is-size-5">
                    Tahu link belajar seru di internet?
                    boleh video youtube, website, artikel, buku dll.
                    share di wissenspace yuk!
                </div><br>
                <a class="button" href='/kontribusi'>Kontribusi 🚀</a>
            </div>
            <div class="insta-feed notification is-primary"></div>
         </div>

         <div class="column is-one-quarter is-hidden-desktop">
               <div>
                   <h3 class="is-size-5 has-text-weight-semibold">Planet</h3>
                   <ul>
                       @foreach ($tags as $tag)
                           <li>
                               <a class="has-text-grey" href="/explore/planet/{{$tag->name}}"> #{{$tag->name}} </a>
                           </li>
                       @endforeach
                   </ul>
               </div>

               <div class="has-small-vm">
                   <h3 class="is-size-5 has-text-weight-semibold">Media</h3>
                   <ul>
                       @foreach ($types as $type)
                           <li>
                               <a class="has-text-grey" href="/explore/media/{{$type->name}}"> {{$type->name}} </a>
                           </li>
                       @endforeach
                   </ul>
               </div>

               <div class="has-small-vm">
                   <h3 class="is-size-5 has-text-weight-semibold">WissenSpace</h3>
                   <a class="has-text-grey"  href="/tentang">Tentang</a> /
                   <a class="has-text-grey" href="/team">Team</a> /
                   <a class="has-text-grey" href="/faq">Tanya</a>
               </div>
           </div>
     </div>

@endsection


@section('page_script')
     <script type="text/javascript">

     // sweetalert
     @if (session('success'))
     swal("Selamat!", "{{ session('success') }}", "success")
     @endif

     //instagram ffeed
    $.get("/explore/load/instagram", function(data){
        if($.trim(data))
        {
            $('.insta-feed').append("<h3 class='subtitle'>Instagram Feed</h3>"+
                "<a href='"+data.url+"' target='_blank'>"+
                    "<img src="+data.last_image+" alt='foto instagram terakhir wissenspace'>" +
                "</a>");
            }
    });


     $(document).ready(function(){
            /*|--------------------------------------------------------------------
              | load more
              |--------------------------------------------------------------------
            */
            $(document).on('click touchstart', '.load-more', function(){
                var _this = $(this).hide();
                var _url = window.location.href  + "/load-more/" + _this.prev('.products').attr('data-id');
                console.log(_url);

                $.get(_url ,function(data){
                  _this.replaceWith(data);
                });
            });
    });
    </script>
@endsection
