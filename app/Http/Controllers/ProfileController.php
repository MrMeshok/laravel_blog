<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Comments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile_view($id)
    {

        $user_obj = new User();
        $user = $user_obj->where('id', '1')->get()->first();

        $comments_obj = new Comments();
        $comments = $comments_obj->where('profile_id', $id)->get();

        return view('profile', ['user' => $user, 'comments' => $comments]);
    }

    public function Comments(Request $request)
    {
        $valid = $request->validate([
            'subject' => 'required|min:5|max:100',
            'message' => 'required|min:5|max:300',
        ]);

        $comment = new Comments();
        $comment->author_id = Auth::user()->id;
        $comment->profile_id = $request->input('profile_id');
        $comment->subject = $request->input('subject');
        $comment->message = $request->input('message');

        $comment->save();
        return redirect()->back();
    }
}
