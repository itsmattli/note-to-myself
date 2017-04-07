<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Image;
use App\Link;
use App\Note;
use App\Tbd;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class NoteController extends Controller
{
    /*
     * Notes
     */

    public function editLink(Request $req) {
        try {
            $link = Link::findOrFail($req->id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error', "Could not edit link, please try again");
            return redirect()->back();
        }
        $link->link = $req->link;
        $link->save();
        return redirect()->back();
    }

    public function deleteLink(Request $req) {
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
        return redirect()->back();
    }

    public function addLink(Request $req) {
        $link = new Link;
        $link->link = $req->link;
        $link->user_ref = Auth::id();
        $link->save();
        return redirect()->back();
    }

    /*
     * Images
     */

    public function addImage() {
        $images = Image::where('user_ref', Auth::id())->count();
        if ($images >= 4) {
            Session::flash('error', "You are only allowed 4 images!");
            return redirect()->back();
        }
    }

    /*
     * Index functions
     */

    public function getImages() {
        return Image::where('user_ref', Auth::id())->get();
    }

    public function getNotes() {
        return Note::where('user_ref', Auth::id())->get();
    }

    public function getLinks() {
        return Link::where('user_ref', Auth::id())->get();
    }

    public function getTbds() {
        return Tbd::where('user_ref', Auth::id())->get();
    }


    public function index() {
        $images = $this->getImages();
        $notes = $this->getNotes();
        $links = $this->getLinks();
        $tbds = $this->getTbds();
        return view('notes', compact('images','links', 'notes', 'tbds'));
    }
}
