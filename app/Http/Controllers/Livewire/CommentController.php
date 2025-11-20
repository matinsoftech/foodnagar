<?php

namespace App\Http\Controllers\Livewire;

use App\Models\Comment;
use App\Models\Product;
use App\Models\AppModule;
use App\Models\VendorType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function store(Request $request){
        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'message' => 'required|string|max:5000',
            'thread_id' => 'nullable',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->product_id = $validatedData['product_id'];
        $comment->message = $validatedData['message'];
        $comment->thread_id = $validatedData['thread_id']??0;
        $comment->save();

        $product_detail = Product::whereId($request->product_id)->first();
        $comments = Comment::with('user')->where('thread_id',0)->where('product_id', $validatedData['product_id'])->get();
        foreach($comments as $comment){
            $comment->replies = Comment::where('thread_id', $comment->id)->get();
        }
        $view = view('livewire.website.modules.product.comments_ssr', compact('comments','request','product_detail'))->render();

        return response()->json(['status' => true, 'message' => 'Comment added successfully!', 'view' => $view]);
    }

    public function update(Request $request,$id)
    {
       // Validate the incoming data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'message' => 'required|string|max:5000',
            'thread_id' => 'nullable',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->message = $validatedData['message'];
        $comment->save();

        return response()->json(['status' => true, 'message' => 'Comment updated successfully!']);
    }

    public function destroy($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['status' => true, 'message' => 'Comment deleted successfully!']);
    }
}
