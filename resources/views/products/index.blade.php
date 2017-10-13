<h1>Welome! @WissenSpace</h1>
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

<h3>Produk lists</h3>
<ul>
    @foreach ($products as $product)
        <a href='/explore/{{$product->slug}}'>
            <img src="{{$product->thumbnail}}" width="100">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->tagline }}</p>
            <p>{{$product->comments_count . ' Komentar'}}</p>
            @foreach ($product->tags as $tag)
                <span>#{{$tag->name}}</span>
            @endforeach
        </a>
        <hr>
        <br>
    @endforeach
</ul>
