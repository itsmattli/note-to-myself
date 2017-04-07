<?php

namespace App\Http\Controllers;
use App\Tbd;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class TBDsController extends Controller
{
    public function update(Request $req) {
        $tbd = Tbd::where('user_ref', Auth::id())->first();
        if(!$tbd) {
            $tbd = new Tbd;
            $tbd->user_ref = Auth::id();
        }
        $tbd->tbd = $req->tbd;

        try {
            $tbd->save();
        } catch (QueryException $e) {
            Session::flash('error', "Could not edit tbd, please try again");
            return redirect()->back();
        }
        Session::flash('active', 'tbd');
        return redirect()->back();
    }
}