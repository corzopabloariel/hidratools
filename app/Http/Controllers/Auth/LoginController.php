<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = 'adm';

    /**
     * Check either username or email.
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        if( method_exists( $this, 'redirectTo' ) )
            return $this->redirectTo();
             
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/adm';
    }

    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            return $next($request);
        }

        return redirect( $this->redirectTo );
    }

    public function login(Request $request) {
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if($this->guard()->validate($this->credentials($request))) {
            if(Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                Auth::user()->fill( [ "login" => date( "U" ) ] );
                Auth::user()->save();
                return redirect( $this->redirectTo );
            }  else {
                $this->incrementLoginAttempts($request);
                return back()->withErrors(['mssg' => "Datos de {$request->username} no encontrados"]);
            }
        } else {
            $this->incrementLoginAttempts($request);
            return back()->withErrors(['mssg' => "Datos de {$request->username} no encontrados"]);
        }
    }

    public function logout( Request $request ) {
        Auth::guard('web')->logout();
        return redirect()->route( $this->redirectTo );
    }
}