<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use Illuminate\Database\QueryException;

class ConfirmController extends Controller
{
    public function confirm($conf_code)
    {
        if(!(isset($conf_code)))
        {
            Session::flash('invalid_url', "URL clicked is invalid, please try again");
            return redirect('/login');
        }

        $user = User::where('confirmation_code', $conf_code)->first();

        if (!$user)
        {
            Session::flash('user_not_found', "No user found with this confirmation code");
            return redirect('/login');
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        try {
            $user->save();
        } catch (QueryException $e) {
            Session::flash('could_not_confirm', "User could not be confirmed, please contact an administrator");
            return redirect('/login');
        }

        Session::flash('confirmed', 'You have successfully verified your account.');

        return redirect('/login');
    }
}
