<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Link;
use App\Note;
use App\Tbd;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class NoteController extends Controller
{
    public function getImages() {
        return Image::where('user_ref', Auth::id());
    }

    public function getNotes() {
        return Note::where('user_ref', Auth::id());
    }

    public function getLinks() {
        return Link::where('user_ref', Auth::id());
    }

    public function getTbds() {
        return Tbd::where('user_ref', Auth::id());
    }

    public function email() {
        $link = 'www.note-to-myself.com';
        Mail::send('email.confirm', ['link' => $link], function ($m) use ($link) {
            $m->from('matthewlidev@gmail.com', 'Note To Myself');
            $m->to('li.matthew.m@gmail.com', 'Matthew')->subject('Your Confirmation Email!');
        });
        return view('notes');
    }

    public function index() {
        $images = $this->getImages();
        $notes = $this->getNotes();
        $links = $this->getLinks();
        $tbds = $this->getTbds();
        return view('notes', compact('images','links', 'notes', 'tbds'));
    }
}
