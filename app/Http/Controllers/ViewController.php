<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;

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
    public function about()
    {

        $users = User::whereHas('posts', function($query) {
            return $query->whereNotNull('published');
        })->get();
        return View('info.about', ['users' => $users]);
    }
    public function join()
    {
        return View('info.join');
    }
    public function contact()
    {
        return View('info.contact');
    }
    public function competitions()
    {
        return View('info.competitions');
    }
    public function terms()
    {
        return View('info.terms');
    }
    public function privacy()
    {
        return View('info.privacy');
    }
    public function trademarks()
    {
        return View('info.trademarks');
    }
    public function cookies()
    {
        return View('info.cookies');
    }
}