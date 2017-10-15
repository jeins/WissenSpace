<h1>{{ $product->name }}</h1>
<h2>{{ $product->tagline }}</h2>
<p> {{$product->created_at->diffForHumans()}} </p>
<a href='{{$product->link}}'>Link: {{$product->link}}</a>

<br>
<img src="{{$product->thumbnail}}" width="100">

<hr>
<p>{{ $product->subject }}</p>

@foreach ($product->tags as $tag)
    <span>#{{$tag->name}}</span>
@endforeach

<hr>
<h3>Astronot (diPost oleh)</h3>
<a href="/profile/{{$product->user->name}}"> {{$product->user->name}} </a>

<hr>
<h3>Makers</h3>
@foreach ($product->makers as $maker)
    <a href='https://twitter.com/{{$maker->twitter_username}}'>{{$maker->name}} </a> -
@endforeach

<hr>
<h3>Diskusi</h3>
@foreach ($product->comments as $comment)
    <p>
        <b><a href="/profile/{{$comment->user->name}}"> {{'@'.$comment->user->name}}</a></b> pada {{$comment->created_at->diffForHumans() }} <br>
        {{$comment->subject}}
    </p>
    @if(Auth::check())
        @if ($comment->user->id === Auth::user()->id)
            <a href="/products/comment/{{$comment->id}}/edit">Edit</a>
        @endif
    @endif
@endforeach

<form action="/products/comment/{{$product->id}}" method="POST">
    <textarea name="subject" placeholder="komentar saya.."rows="8" cols="80"></textarea>
    {{csrf_field()}}
    <input type="submit" value="post komentar">
</form>
<br>
