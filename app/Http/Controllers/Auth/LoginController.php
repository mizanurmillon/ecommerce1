<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //__login method__//
    public function login(Request $request)
    {
        $validated= $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        if (auth()->attempt(array('email'=>$request->email,'password'=>$request->password))) {
            if (auth()->user()->is_admin==1) {
                return redirect()->route('admin.home');
            }else{
                return redirect()->back();
            }
        }else{
            $notification=array('message' => 'email or password invalid!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    //__Login page__//
    public function AdminLogin()
    {
        return view('auth.admin_login');
    }
}
