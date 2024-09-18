<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //__user logout method__//

    public function userLogout()
    {
        Auth::logout();
        $notification = array('message' => 'You are logged out!','alert-type'=>'warning' );
        return redirect()->route('login')->with($notification);
    }
}
