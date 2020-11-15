<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Shared_libraries;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function library($id)
    {
        if (Auth::user()) {
            $user = Auth::user();
        } else {
            $user = NULL;
        }
        $url = url()->current();
        $profile = User::where('id', $id)->get()->first();
        $books = Book::where('user_id', $id)->get();

        return view('library', ['profile' => $profile, 'books' => $books, 'user' => $user, 'url' => $url]);
    }

    public function read_book($id, $book_id)
    {
        $book = Book::where('id', $book_id)->get()->first();
        return view('book')->with('book', $book);
    }

    public function edit_book(Request $request)
    {
        $valid = $request->validate([
            'title' => 'required|min:5|max:100',
            'text' => 'required|min:5|max:300',
            'id' => 'required|integer|exists:books,id',
        ]);
        $book = Book::find($request->input('id'));
        $book->title = $request->input('title');
        $book->text = $request->input('text');
        $book->save();
        return redirect()->back();
    }

    public function del_book($id, $book_id)
    {
        if (Auth::user()->id == $id) {
            $book = Book::where('id', $book_id)->delete();
        }
        return redirect()->back();
    }

    public function add_book(Request $request)
    {
        $valid = $request->validate([
            'title' => 'required|min:5|max:100',
            'text' => 'required|min:5|max:300',
            'library_id' => 'required|integer|exists:users,id',
        ]);

        if (Auth::user()->id == $request->input('library_id')) {
            $book = new Book();
            $book->user_id = $request->input('library_id');
            $book->title = $request->input('title');
            $book->text = $request->input('text');
            $book->save();
        }

        return redirect()->back();
    }

    public function change_public($id)
    {
        if (Auth::user()->id == $id) {
            $library = User::find($id);
            $library->public_library ^= 1;
            $library->save();
        }
        return redirect()->back();
    }

    public function share_library($profile_id)
    {
        $shared_libraries = Shared_libraries::where('library_id', $profile_id)->where('user_id', Auth::user()->id)->get()->first();
        if ($shared_libraries) {
            Shared_libraries::where('library_id', $profile_id)->where('user_id', Auth::user()->id)->delete();
        } else {
            $share = new Shared_libraries();
            $share->library_id = $profile_id;
            $share->user_id = Auth::user()->id;
            $share->save();
        }
        return redirect()->back();
    }
}
