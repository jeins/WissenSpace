@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-multiline">
            <div class="column">
                <div class="tile">
                    <div class="tile is-parent is-vertical">
                        <div class="tile is-child box">
                            <article class="media">
                                <div class="media-left">
                                    <figure class="image is-128x128">
                                        <img src="{{$product->thumbnail ?: 'https://cdn1.iconfinder.com/data/icons/business-charts/512/customer-512.png'}}"
                                             alt="{{$product->name}}">
                                    </figure>
                                </div>
                                <div class="media-content">
                                    <div class="content">
                                        <div class="level">
                                            <div class="level-left">
                                                <h1 class="title">{{$product->name}}</h1>
                                            </div>

                                            <div class="level-right">
                                                <span class="button is-static">{{$product->created_at->diffForHumans()}}</span>
                                            </div>
                                        </div>
                                        <p>{{$product->tagline}}</p>

                                        @if (Auth::check())
                                            @if (Auth::user()->id === $product->user->id)
                                                <a class="button" href='#'>Edit</a>
                                            @endif
                                        @endif
                                    </div>
                                    <nav class="level">
                                        <div class="level-left">
                                            <div class="tags">
                                                @foreach ($product->tags as $tag)
                                                    <span class="level-item tag">#{{$tag->name}}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="level-right">
                                            <div class="tags">
                                                <span class="tag">
                                                    <span class="icon is-small">
                                                      <i class="fa fa-heart"></i>
                                                    </span>
                                                    <span>0</span>
                                                </span>
                                                <span class="tag">
                                                    <span class="icon is-small">
                                                      <i class="fa fa-comment"></i>
                                                    </span>
                                                    <span>0</span>
                                                </span>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </article>
                        </div>
                        @if($product->images)
                            <div class="tile is-child box">
                                <div class="columns">
                                    <div class="column">
                                        <figure class="image is-4by3">
                                            <img id="show-image" src="{{$product->images[0]}}">
                                        </figure>
                                    </div>
                                </div>
                                <div class="columns is-multiline">
                                    @foreach ($product->images as $image)
                                        <div class="column is-narrow">
                                            <a class="product-image-thumbnail image is-64x64" image-url="{{$image}}">
                                                <img src="{{$image}}">
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
                                        {{--TODO:::--}}
                                        <a class="button is-danger level-item">
                                                    <span class="icon">
                                                      <i class="fa fa-heart-o"></i>
                                                    </span>
                                            <span>Like</span>
                                        </a>
                                        <a class="button is-primary level-item">
                                                    <span class="icon">
                                                      <i class="fa fa-globe"></i>
                                                    </span>
                                            <span>Website</span>
                                        </a>
                                    </div>
                                </nav>
                                <p>{{$product->subject}}</p>
                            </div>
                        </div>
                        <div class="tile is-child box">
                            <p class="title">Diskusi</p>

                            <div class="columns">
                                <div class="column">
                                    <form action="{{route('product.comment.post', $product->id)}}" role="form" method="POST">
                                        <textarea name="subject" placeholder="komentar saya.."rows="8" cols="80" class="is-flex"></textarea>
                                        {{csrf_field()}}
                                        <br>
                                        <button class="button is-success" type="submit">
                                            Post Komentar
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @foreach ($product->comments as $comment)
                                <div>
                                    <hr>
                                    <article class="media">
                                        <div class="media-left">
                                            <figure class="image is-64x64">
                                                <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                                            </figure>
                                        </div>
                                        <div class="media-content">
                                            <div class="content">
                                                <b><a href="/profile/{{$comment->user->name}}"> {{'@'.$comment->user->name}}</a></b> - </b> pada {{$comment->created_at->diffForHumans() }} <br>
                                                <p>{{$comment->subject}}</p>
                                            </div>
                                            @if(Auth::check())
                                                @if ($comment->user->id === Auth::user()->id)
                                                    <nav class="level">
                                                        <div class="level-left">
                                                            <a class="button is-small" href="/products/comment/{{$comment->id}}/edit">
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
                        <div class="tile is-child box">
                            <h3 class="subtitle">Astronot</h3>
                            <a href="/profile/{{$product->user->name}}"> {{$product->user->name}} </a>
                        </div>
                        <div class="tile is-child box">
                            <h3 class="subtitle">Pemilik</h3>
                            @foreach ($product->makers as $maker)
                                <a href='https://twitter.com/{{$maker->twitter_username}}'>{{$maker->name}} </a> -
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script type="text/javascript">
        $('.product-image-thumbnail').click(function(){
            var imageUrl = $(this).attr('image-url');
            $('#show-image').attr('src', imageUrl);
        })
    </script>
@endsection
