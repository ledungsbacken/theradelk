<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class ViewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function master()
    {
        return view('master');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        if(Auth::check()) {
            return view('admin');
        }
        return redirect('login');
    }
}
