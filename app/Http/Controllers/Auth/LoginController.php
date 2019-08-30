<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout()
    {
        auth()->logout();
        session()->flush();
        return redirect('/');
    }

    public function get_autenticar()
    {
        return view('vendor.adminlte.login');
    }

    public function post_autenticar(Request $request)
    {

        $credentials = $request->only(['email', 'password']);

        if(auth()->attempt($credentials))
        {

            if(auth()->user()->isRoot)
                return redirect()->route('root');

            if(auth()->user()->isAdmin)
                return redirect()->route('admin');

            if(auth()->user()->isStudent)
                return redirect()->route('student');    

        }
    }
}
