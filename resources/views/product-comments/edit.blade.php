@extends('layouts.app')

@section('content')
    <div class="section">
        <h1>Edit Komentar {{ $comment->product->name}}</h1>
    </div>

    <div class="section">
        <form action="/products/comment/{{$comment->id}}/" method="POST">
            @if ($errors->has('subject'))
                 <p class="help is-danger">{{ $errors->first('subject') }}</p>
            @endif
            <textarea name="subject" placeholder="komentar saya.." class="textarea">{{$comment->subject}}</textarea>
            <input name="_method" type="hidden" value="PUT">
            {{csrf_field()}}
            <br>
            <input type="submit" class="button is-success" value="edit komentar">
        </form>
    </div>
@endsection
