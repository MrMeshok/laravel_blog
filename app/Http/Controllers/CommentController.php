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
		$valid = $request->validate([
			'subject' => 'required|min:5|max:100',
			'message' => 'required|min:5|max:300',
			'profile_id' => 'required|integer|exists:users,id',
		]);

		$comment = new Comment();
		$comment->author_id = Auth::user()->id;
		$comment->profile_id = $request->input('profile_id');
		if ($request->input('reply_id')) {
			$comment->reply_id = $request->input('reply_id');
		}
		$comment->subject = $request->input('subject');
		$comment->message = $request->input('message');

		$comment->save();
		return redirect()->back();
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
		$auth = Auth::user();
		$user = User::where('id', $profile_id)->get()->first();
		$url = url()->current();

		$count = Comment::where('profile_id', $profile_id)->count();
		$skip = 5;
		$limit = $count - $skip;
		$comments = Comment::where('profile_id', $profile_id)->skip($skip)->take($limit)->get();;
		// $comments = Comment::where('profile_id', $profile_id)->skip(5)->take(PHP_INT_MAX)->get();;

		// return view('profile_rest_comments')->with(['user' => $user, 'comments' => $comments, 'auth' => $auth, 'url' => $url])->render();
		$new_comments = view('profile_rest_comments', ['user' => $user, 'comments' => $comments, 'auth' => $auth, 'url' => $url])->render();

		// return json_encode($comments);
		// return dump($comments);
		return response()->json($new_comments);
	}

	public function user_comments()
	{

		$comments = Comment::where('author_id', Auth::user()->id)->get();

		return view('user_comments', ['comments' => $comments]);
	}
}
