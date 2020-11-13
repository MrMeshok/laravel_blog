<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function Add_comment(Request $request)
    {
        // $valid = $request->validate([
        //     'subject' => 'required|min:5|max:100',
        //     'message' => 'required|min:5|max:300',
        //     'profile_id' => 'required|integer',
        // ]);

        $check_user = User::where('id', 5)->get()->first();
        dd($check_user);
        // $comment = new Comment();
        // $comment->author_id = Auth::user()->id;
        // $comment->profile_id = $request->input('profile_id');
        // if ($request->input('reply_id')) {
        //     $comment->reply_id = $request->input('reply_id');
        // }
        // $comment->subject = $request->input('subject');
        // $comment->message = $request->input('message');

        // $comment->save();
        // return redirect()->back();
    }

    public function del_comment($profile_id, $id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $user_id = Auth::user()->id;
        if ($user_id == $profile_id) {
            Comment::where('profile_id', $profile_id)->where('id', $id)->delete();
        } else {
            Comment::where('profile_id', $profile_id)->where('author_id', $user_id)->where('id', $id)->delete();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        return redirect()->back();
    }
    public function all_comments($profile_id)
    {
        // $comments = Comment::where('profile_id', $id)->get();
        return $profile_id;
    }
}
