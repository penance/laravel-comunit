<?php

namespace App\Http\Controllers;
use Auth;
use App\AccessLevel;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class PagesController extends Controller
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
       return 'pages index';
    }

    public function unauthorized ()
    {
        return View('common.unauthorized');
    }
}
