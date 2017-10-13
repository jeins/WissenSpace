<h1>Profile {{$user->name}}</h1>

<h2>Links {{$user->products->count()}}</h2>
@foreach ($user->products as $product)
    <a href="/explore/{{$product->slug}}">{{$product->name}}</a>
@endforeach

<h2>Komentar {{$user->product_comments->count()}}</h2>
@foreach ($user->product_comments as $product_comment)
    <a href="/explore/{{$product_comment->product->slug}}">{{$product_comment->subject}}</a>
@endforeach
