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
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function getNote() {
        return Note::where('user_ref', Auth::id())->first();
    }

    public function getLinks() {
        return Link::where('user_ref', Auth::id())->get();
    }

    public function getTbd() {
        return Tbd::where('user_ref', Auth::id())->first();
    }


    public function index() {
        $images = $this->getImages();
        $note = $this->getNote();
        $links = $this->getLinks();
        $tbd = $this->getTbd();
        return view('notes', compact('images','links', 'note', 'tbd'));
    }
}
