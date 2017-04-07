<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;

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

    use AuthenticatesUsers {
        login as login;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/notes';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $user = User::where('email',$request->email)->first();

        if ($user) {
            if ($user->locked == 1) {
                return redirect()->back()->with("error", "Account is locked out for too many failed login attempts, please check your email to unlock this account");
            }
            if($user->confirmed == 0) {
                return redirect()->back()->with("error", "Please confirm your email before attempting to login");
            }
        }
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
/*        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }*/

        if ($this->attemptLogin($request)) {
            $user->login_attempts = 0;
            $user->save();
            return $this->sendLoginResponse($request);
        }

        if($user) {
            $user->login_attempts = $user->login_attempts + 1;
            if($user->login_attempts >= 3) {
                $conf = str_random(30);
                $user->locked = 1;
                $user->confirmation_code = $conf;
                $user->save();
                Mail::send('email.unlock', ['confirmation_code' => $conf], function($message) use ($user) {
                    $message->to($user->email, null)
                        ->subject('Unlock your Account');
                });
                return redirect()->back()->with("error", "Too many failed login attempts, account has been locked. Please check your email for instructions to unlock");
            }
            $user->save();
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        //$this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
