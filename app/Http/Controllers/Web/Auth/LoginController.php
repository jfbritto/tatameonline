<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;
use Exception;
use App\Models\User;
use App\Services\HistoricService;

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
    public function __construct(HistoricService $historic)
    {
        $this->middleware('guest')->except('logout');
        $this->historicService = $historic;
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

        if($request->email == 'root@hotmail.com'){
            $credentials = array('email' => $request->email, 'password' => $request->password);
        }else{
            $credentials = array('email' => $request->email, 'password' => $request->password, 'idAcademy' => $request->idAcademy);

        }


        if(auth()->attempt($credentials))
        {

            if(auth()->user()->isActive==0){
                auth()->logout();
                session()->flush();
                return redirect(route('site').'#login')->with('error', 'Usuário inativo!');
            }

            $this->historicService->store(['idUser'=>auth()->user()->id,'description'=>'Login de usuário.', 'idHistoricType'=>1,'actionDate'=>date("Y-m-d H:i:s")]);

            if(auth()->user()->isRoot){
                return redirect()->route('root');
            }

            if(auth()->user()->isAdmin){
                return redirect()->route('admin');
            }

            if(auth()->user()->isInstructor){
                return redirect()->route('instructor');
            }

            if(auth()->user()->isStudent){
                return redirect()->route('student');
            }



        }else{
            return redirect(route('site').'#login')->with('error', 'E-mail ou senha incorretos!');
        }
    }
}
