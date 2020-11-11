<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function Comments(Request $request)
    {
        $valid = $request->validate([
            'subject' => 'required|min:5|max:100',
            'message' => 'required|min:5|max:300',
        ]);

        $comment = new Comment();
        $comment->author_id = Auth::user()->id;
        $comment->profile_id = $request->input('profile_id');
        $comment->subject = $request->input('subject');
        $comment->message = $request->input('message');

        $comment->save();
        return redirect()->back();
    }
}
