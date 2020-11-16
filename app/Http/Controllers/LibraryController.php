<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Shared_libraries;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function library($user_id)
    {
        $user = Auth::user();
        $url = url()->current();

        $profile = User::where('id', $user_id)->get()->first();
        $books = Book::where('user_id', $user_id)->get();

        if ($profile and $books) {
            return view('library', ['profile' => $profile, 'books' => $books, 'user' => $user, 'url' => $url]);
        } else {
            return redirect('');
        }
    }

    public function read_book($user_id, $book_id)
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
        if (Auth::user()->id == $book->user_id) {
            $book->title = $request->input('title');
            $book->text = $request->input('text');
            $book->save();
        }
        return redirect()->back();
    }

    public function del_book($user_id, $book_id)
    {
        $book = Book::where('id', $book_id)->where('user_id', Auth::user()->id)->delete();
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

    public function change_public($user_id)
    {
        // dd($user_id);
        if (Auth::user()->id == $user_id) {
            $library = User::find($user_id);
            $library->public_library ^= 1;
            $library->save();
        }
        return redirect()->back();
    }

    public function share_library($user_id)
    {
        if (User::find($user_id)) {
            $shared_libraries = Shared_libraries::where('library_id', Auth::user()->id)->where('user_id', $user_id)->get()->first();
            if ($shared_libraries) {
                Shared_libraries::where('library_id', Auth::user()->id)->where('user_id', $user_id)->delete();
            } else {
                $share = new Shared_libraries();
                $share->library_id = Auth::user()->id;
                $share->user_id = $user_id;
                $share->save();
            }
        }
        return redirect()->back();
    }
}
