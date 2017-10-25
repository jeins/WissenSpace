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
    <div class="columns">
      <div class="column is-one-quarter">
            <h3>Planet</h3>
            <ul>
                @foreach ($tags as $tag)
                    <li>
                        <a href="/explore/planet/{{$tag->name}}"> {{$tag->name}} </a>
                    </li>
                @endforeach
            </ul>

            <h3>Media</h3>
            <ul>
                @foreach ($types as $type)
                    <li>
                        <a href="/explore/media/{{$type->name}}"> {{$type->name}} </a>
                    </li>
                @endforeach
            </ul>

            <hr>
            <a href="/tentang">Tentang</a> /
            <a href="/team">Team</a> /
            <a href="/faq">Tanya</a>
            <hr>
            <a href="https://twitter.com/wissenspace">Twitter</a> /
            <a href="https://facebook.com/wissenspace">Facebook</a> /
            <a href="https://instagram.com/wissenspace">Instagram</a>

        </div>

        <div class="column">
            <ul>
                @foreach ($products->take(2) as $product)
                    <div id="products">
                        <a href='/explore/{{$product->slug}}' class="each-product" data-id="{{$product->id}}">
                            <img src="{{$product->thumbnail}}" width="100">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ $product->tagline }}</p>
                            <p>{{$product->comments_count . ' Komentar'}}</p>
                            @foreach ($product->tags as $tag)
                                <span>#{{$tag->name}}</span>
                            @endforeach
                        </a>
                    </div>
                @endforeach

                <!-- loadmore  -->
                @if($products->count() > 2)
                  <a class="button is-primary load-more">Explore Lagi</a>
                @endif
            </ul>

        </div>
     </div>

@endsection


@section('page_script')
     <script type="text/javascript">

     $(document).ready(function(){
            /*|--------------------------------------------------------------------
              | load more
              |--------------------------------------------------------------------
            */
            $(document).on('click touchstart', '.load-more', function(){
                var _this = $(this).hide();
                var _url = window.location.href  + "/load-more/" + _this.prev('#products').find('.each-product').last().attr('data-id');

                $.get(_url ,function(data){
                  _this.replaceWith(data);
                });
            });
    });
    </script>
@endsection
