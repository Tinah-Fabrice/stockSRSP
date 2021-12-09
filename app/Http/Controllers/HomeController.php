<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function redirectTo()
    {
        if (is_null(auth()->user())){
            return '/login';
        }
        return '/home';
    }
    
    public function index()
    {
        return view('home');
    }
}
