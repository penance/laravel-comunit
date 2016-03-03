<?php

namespace App\Http\Controllers;
use Auth;
use App\AccessLevel;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::check()){
           // $userData = Auth::user()->accessLevel();
            $userData = Auth::user()->accessLevel->title;
        } else {
            $userData = 'not logged';
        }


        return view('home')->with(array('userData' => $userData));
    }
}
