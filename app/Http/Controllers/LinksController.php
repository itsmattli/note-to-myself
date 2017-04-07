<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LinksController extends Controller
{
    public function update(Request $req) {
        Session::flash('active', 'link');
        try {
            $link = Link::findOrFail($req->id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error', "Could not edit link, please try again");
            return redirect()->back();
        }
        $link->link = $req->link;
        $link->save();
        return redirect()->back()->with("success", "Link was added!");
    }

    public function delete(Request $req) {
        Session::flash('active', 'link');
        try {
            $link = Link::findOrFail($req->id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error', "Could not find associated link, please try again");
            return redirect()->back();
        }
        try {
            $link->delete();
        } catch (QueryException $e) {
            Session::flash('error', "Could not delete associated link, please try again");
            return redirect()->back();
        }
        return redirect()->back()->with("success", "Link was deleted!");
    }

    public function create(Request $req) {
        $link = new Link;
        $link->link = $req->link;
        $link->user_ref = Auth::id();
        $link->save();
        Session::flash('active', 'link');
        return redirect()->back()->with("success", "Link was created!");
    }
}
