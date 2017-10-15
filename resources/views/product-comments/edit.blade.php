<form action="/products/comment/{{$comment->id}}/" method="POST">
    <textarea name="subject" placeholder="komentar saya.."rows="8" cols="80">{{$comment->subject}}</textarea>
    <input name="_method" type="hidden" value="PUT">
    {{csrf_field()}}
    <input type="submit" value="edit komentar">
</form>
