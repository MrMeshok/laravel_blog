<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Shared_libraries;

class ShareableLibrary
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $have_access = Shared_libraries::where('library_id', $request->id)->where('user_id', $user_id)->get()->first();
        }
        $public = User::where('id', $request->id)->where('public_library', 1)->get()->first();

        if ($public or $have_access or $user_id == $request->id) {
            return $next($request);
        } else {
            return redirect('HOME');
        }
        
    }
}
