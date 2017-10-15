<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductComment;

class ProductCommentController extends Controller
{
    public function save(Request $request, $id)
    {
        $product = Product::find($id);
        $product->comments()->create([
            'subject' => $request->subject,
            'user_id' => Auth::user()->id
        ]);

        return redirect('explore/'.$product->slug)->with('success', 'komentar anda berhasil dipost, +1 kontribusi');
    }

    public function edit($comment_id)
    {
        $comment = ProductComment::find($comment_id);

        if($comment->user_id !== Auth::user()->id)
            abort(403);

        return view('product-comments.edit', compact('comment'));
    }

    public function update(Request $request, $comment_id)
    {
        $comment = ProductComment::find($comment_id);
        $product = Product::find($comment->product_id);

        if($comment->user_id !== Auth::user()->id)
            abort(403);

        $comment->update([
            'subject' => $request->subject
        ]);

        return redirect('explore/'.$product->slug)->with('success', 'komentar anda berhasil diedit, +1 kontribusi');
    }
}
