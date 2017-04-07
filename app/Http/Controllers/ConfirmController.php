<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use Illuminate\Database\QueryException;

class ConfirmController extends Controller
{
    public function confirm($conf_code){
        if(!(isset($conf_code))) {
            Session::flash('error', "URL clicked is invalid, please try again");
            return redirect('/login');
        }

        $user = User::where('confirmation_code', $conf_code)->first();

        if (!$user) {
            Session::flash('error', "No user found with this confirmation code");
            return redirect('/login');
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        try {
            $user->save();
        } catch (QueryException $e) {
            Session::flash('error', "User could not be confirmed, please contact an administrator");
            return redirect('/login');
        }

        Session::flash('confirmed', 'You have successfully verified your account.');

        return redirect('/login');
    }

    public function unlock($conf_code){
        if(!(isset($conf_code))) {
            Session::flash('error', "URL clicked is invalid, please try again");
            return redirect('/login');
        }

        $user = User::where('confirmation_code', $conf_code)->first();

        if (!$user) {
            Session::flash('error', "No user found with this confirmation code");
            return redirect('/login');
        }

        $user->locked = 0;
        $user->login_attempts = 0;
        $user->confirmation_code = null;
        try {
            $user->save();
        } catch (QueryException $e) {
            Session::flash('error', "User could not be unlocked, please contact an administrator");
            return redirect('/login');
        }

        Session::flash('confirmed', 'You have successfully unlocked your account.');

        return redirect('/login');
    }
}
