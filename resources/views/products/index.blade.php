@extends('layouts.app')

@section('content')
    <h1>Welome! @WissenSpace</h1>
    <div class="columns">
      <div class="column is-one-quarter">
        <a href="/kontribusi">+ Post</a>

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
        </div>

        <div class="column">
            <h3>Produk lists</h3>
            <ul>
                @foreach ($products->take(10) as $product)
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
                @if($products->count() > 10)
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
                var _url = "/explore/load-more/" + _this.prev('#products').find('.each-product').last().attr('data-id');

                $.get(_url ,function(data){
                  _this.replaceWith(data);
                });
            });
    });
    </script>
@endsection
