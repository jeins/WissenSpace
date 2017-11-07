@extends('layouts.app')

@section('meta-data')
    <title>{{$product->name . ' - ' . $product->tagline}}</title>
    <meta name="author" content="WissenSpace Team">
    <meta name="description" content="{{ $product->subject }}">
    <!-- twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{$product->name . ' - ' . $product->tagline}}">
    <meta name="twitter:creator" content="WissenSpace Team">
    <meta name="twitter:title" content="{{$product->name . ' - ' . $product->tagline}}">
    <meta name="twitter:url" content="https://wissenspace.com/explore/{{$product->slug}}">
    <meta name="twitter:description" content="{{ $product->subject }}">
    <meta name="twitter:image:src" content="{{$product->thumbnail}}">
    <!-- facebook -->
    <meta property="og:title" content="{{$product->name . ' - ' . $product->tagline}}"/>
    <meta property="og:description" content="{{ $product->subject }}">
    <meta property="og:image" content="{{$product->thumbnail}}">
@endsection

@section('page_css')
    <style>
        .video-wrapper {
            display: none;
            position: relative;
            padding-bottom: 56.25%;
            padding-top: 25px;
            height: 0;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="columns is-multiline">
        <div class="column">
            <div class="tile">
                <div class="tile is-parent is-vertical">
                    <div class="tile is-child box">
                        <article class="products media">
                            <div class="media-left">
                                <figure class="image is-128x128">
                                    <img src="{{$product->thumbnail ?: route('image.view', [\App\Http\Controllers\ImageController::WISSENSPACE_TYPE, 'no_user_photo.png'])}}"
                                         alt="{{$product->name}}">
                                </figure>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <h1 class="title is-size-4">{{$product->name}}</h1>
                                    <h2 class="subtitle is-size-5">{{$product->tagline}}</h2>

                                    @if (Auth::check())
                                        @if (Auth::user()->id === $product->user->id)
                                            <a class="button" href='{{route('product.edit', $product->id)}}'>Edit</a>
                                        @endif
                                    @endif
                                </div>
                                <div class="level">
                                    <div class="level-left">
                                        <div class="tags">
                                            @foreach ($product->tags as $tag)
                                                <span class="level-item tag">
                                                    <a href="/explore/planet/{{$tag->name}}">#{{$tag->name}}</a>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="level-right">
                                        <div class="tags">
                                            <span class="tag">
                                                <span class="">{{$product->created_at->diffForHumans()}}</span>
                                            </span>
                                            <span class="tag">
                                                <span class="icon is-small">
                                                  <i class="fa fa-comment"></i>
                                                </span>
                                                <span>{{$product->comments->count()}}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <a href="#" class="button is-danger is-hidden-desktop" id="like_button" data-product-id="{{$product->id}}">
                                    <span class="icon is-small">
                                      <i class="fa fa-heart"></i>
                                    </span>
                                    <span id="like_total">{{$product_votes}}</span>
                                </a>
                            </div>
                        </article>
                    </div>
                    @if($product->images && $product->images !== 'null')
                        <div class="tile is-child box">
                            <div class="columns">
                                <div class="column">
                                    <figure class="image is-3by2">
                                        <img width="560" height="350" id="show-image" src="{{$product->images[0]}}/560/350" onclick="displayImageModal(this)" style="cursor: pointer;">
                                    </figure>
                                    <div class="video-wrapper">
                                        <iframe width="560" height="350" frameborder="0" src="{{$product->youtube_id}}"
                                                allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="columns is-multiline">
                                @foreach ($product->images as $image)
                                    <div class="column is-narrow">
                                        <a class="product-image-thumbnail image is-64x64" image-url="{{$image}}/560/350">
                                            <img src="{{$image}}/64/64">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="tile is-child box">
                        <div class="content">
                            <nav class="level">
                                <div class="level-left">
                                    <a class="button is-primary level-item" href='{{ (stristr($product->link, 'http') != TRUE) ? 'http://'.trim($product->link) : $product->link }}' target="_blank">
                                                <span class="icon">
                                                  <i class="fa fa-globe"></i>
                                                </span>
                                        <span>Website</span>
                                    </a>
                                </div>
                            </nav>
                            <p class="is-long-text">{!! $product->subject !!}</p>
                        </div>
                    </div>
                    <div class="tile is-child box">
                        <p class="title">Diskusi</p>
                        @if (Auth::check())
                            <div class="columns">
                                <div class="column">
                                    <form action="{{route('product.comment.post', $product->id)}}" role="form"
                                          method="POST">
                                        @if ($errors->has('subject'))
                                            <p class="help is-danger">{{ $errors->first('subject') }}</p>
                                        @endif
                                        <textarea name="subject" placeholder="komentar saya.."
                                                  class="textarea"></textarea>
                                        {{csrf_field()}}
                                        <br>
                                        <button class="button is-success" type="submit">
                                            Post Komentar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a onclick='$(".modal.login").addClass("is-active")' class="button"> Login untuk komentar</a>
                        @endif

                        @foreach ($product->comments as $comment)
                            <div>
                                <hr>
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-64x64">
                                            <img src="{{$comment->user->photo ? route('image.view', ['type' => \App\Http\Controllers\ImageController::USER_TYPE, 'image' => $comment->user->photo]): route('image.view', [\App\Http\Controllers\ImageController::WISSENSPACE_TYPE, 'no_user_photo.png'])}}" alt="Image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <b><a href="/profile/{{$comment->user->name}}"> {{'@'.$comment->user->name}}</a></b>
                                            - </b> pada {{$comment->created_at->diffForHumans() }} <br>
                                            <p class="is-long-text">{{$comment->subject}}</p>
                                        </div>
                                        @if(Auth::check())
                                            @if ($comment->user->id === Auth::user()->id)
                                                <nav class="level">
                                                    <div class="level-left">
                                                        <a class="button is-small"
                                                           href="/products/comment/{{$comment->id}}/edit">
                                                                <span class="icon">
                                                                  <i class="fa fa-pencil"></i>
                                                                </span>
                                                            <span>Edit</span>
                                                        </a>
                                                    </div>
                                                </nav>
                                            @endif
                                        @endif
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="column is-one-quarter">
            <div class="tile">
                <div class="tile is-parent is-vertical">
                    <a href="#" class="tile is-child button is-danger is-hidden-touch" id="like_button" data-product-id="{{$product->id}}">
                        <span class="icon is-small">
                          <i class="fa fa-heart"></i>
                        </span>
                        <span id="like_total">{{$product_votes}}</span>
                    </a>

                    <div class="tile is-child box">
                        <h3 class="subtitle">Astronot</h3>
                        <a href="/profile/{{$product->user->name}}"> {{$product->user->name}} </a>
                    </div>
                    <div class="tile is-child box">
                        <h3 class="subtitle">Pemilik</h3>
                        @if($product->makers->count())
                            @foreach ($product->makers as $maker)
                                <li>
                                @if (!empty($maker->twitter_username))
                                    <a href='https://twitter.com/{{$maker->twitter_username}}'>{{$maker->name}} </a>
                                @else
                                    {{$maker->name}}
                                @endif
                                </li>
                            @endforeach
                        @else
                            <li>Tidak ada keterangan</li>
                        @endif
                    </div>

                    <a class="button is-info" href="/explore">Kembali ke Galaksi </a>

                </div>
            </div>
        </div>
    </div>

    @include('products.image_modal')
@endsection

@section('page_script')
    <script type="text/javascript">
        // sweetalert
        @if (session('success'))
        swal("Selamat!", "{{ session('success') }}", "success")
        @endif

        //Like system
        $('#like_button').on('click', function(){
            var _this = $(this);
            var _url  = "/product/like/" + _this.attr('data-product-id');

            $.get(_url).done(function(data){
                var _likeTotal = _this.find('#like_total');
                if (data['status'] == 'like'){
                    _likeTotal.html(parseInt(_likeTotal.html())+ 1);
                    swal("Berhasil!", "makasih feedbacknya!", "success");
                } else {
                    _likeTotal.html(parseInt(_likeTotal.html())- 1);
                }
            }).fail(function(error){
                if(error.status == 401)
                    window.location = "/login";
            });
        });

        $('.product-image-thumbnail').click(function () {
            var imageUrl = $(this).attr('image-url');

            if (imageUrl.indexOf('youtube') >= 0) {
                $('#show-image').parent().hide();
                $('.video-wrapper').show();
            } else {
                $('.video-wrapper').hide();
                $('#show-image').parent().show();
                $('#show-image').attr('src', imageUrl);
            }
        })

        function displayImageModal(img){
            $(".modal.image-show").addClass("is-active");

            var imageUrl = $(img).attr('src');
            $(".image-modal").attr('src', imageUrl.substring(0, imageUrl.length - 8));
        }

        $(".modal-close.image-show, .modal-background").click(function () {
            $(".modal.image-show").removeClass("is-active");
            return false;
        })
    </script>
@endsection
