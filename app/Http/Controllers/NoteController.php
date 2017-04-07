<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Link;
use App\Note;
use App\Tbd;
use Illuminate\Support\Facades\Auth;


class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * Index functions
     */

    public function getPictures() {
        return Picture::where('user_ref', Auth::id())->get();
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
        $pictures = $this->getPictures();
        $note = $this->getNote();
        $links = $this->getLinks();
        $tbd = $this->getTbd();
        return view('notes', compact('pictures', 'links', 'note', 'tbd'));
    }
}
