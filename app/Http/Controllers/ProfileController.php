<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\User;
use App\Models\Shared_libraries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile_view($id)
    {
        $user = User::where('id', $id)->get()->first();

        $comments = Comment::where('profile_id', $id)->get();
        // $comments = User::find($id)->comments_for_profile()->get();

        $auth = Auth::user();
        $url = url()->current();
        $library_access = Shared_libraries::where('library_id', $id)->where('user_id', $auth->id)->get()->first();
        // Comment::find(1)->replays
        // dd(Comment::find(2)->Author);
        // dd(Comment::find($id)->Author);

        if ($user) {
            return view('profile', ['user' => $user, 'comments' => $comments, 'auth' => $auth, 'url' => $url, 'library_access' => $library_access]);
        } else {
            return redirect('');
        }

        
        // $users = User::with('comment')->get();
        // foreach ($users->flatMap->comment as $value) {
        //     echo $value->Author.'<br>';
        // }
    }

    public function all_users()
    {
        $users = User::get();
        if ($users) {
            return view('users')->with('users', $users);
        } else {
            return redirect('');
        }
    }

    
}
