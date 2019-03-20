<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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
    protected $redirectAfterLogout = '/';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Redefine Logout method
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect($this->redirectAfterLogout);
    }

    /**
     * Login user using ajax
     * @param Request $request
     * @return array
     */
    public function loginAjax(Request $request){
        if(!$request->username || !$request->password){
            return ['has_error' => true,'error_message' => 'Wrong Request, please review'];
        }
        if(filter_var($request->username, FILTER_VALIDATE_EMAIL) && Auth::attempt(['email' => $request->username, 'password' => $request->password],$request->remember_me)){
            $user = User::with('recharge')->where('email',$request->username)->first();
            return ['has_error' => false, 'error_message' => 'Usuario logged', 'data' => compact('user')];
        } elseif(Auth::attempt(['phone_number' => $request->username, 'password' => $request->password],$request->remember_me)){
            $user = User::with('recharge')->where('phone_number',$request->username)->first();
            return ['has_error' => false, 'error_message' => 'Usuario logged', 'data' => compact('user')];
        }
        dd(Auth::user()->email);
        return ['has_error' => true, 'error_message' => 'Usuario o password incorrecto'];
    }

    /**
     *
     * @param Request $request
     * @return array
     */
    public function registerUserAjax(Request $request){
        //todo: Revisar request en el trabajo
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
           return ['has_error' => true,'error_message' => 'Email Invalido, ya existe en nuestra Aplicacion'];
        }


        if(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'notification' => $request->notification
            ]);

            return ['has_error' => false,'error_message' => 'Usuario creado correctamente!!', 'data' => compact('user')];
        }

        return ['has_error' => true,'error_message' => 'Email Invalido, por favor revisalo!'];


    }


}
