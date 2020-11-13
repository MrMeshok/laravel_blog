<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect()
    {
        // return dd(Auth::user());
        
        if (Auth::user()) {
            $route = 'profile/'.Auth::user()->id;
        } else {
            $route = 'login';
        }
        return redirect($route);
    }
}
