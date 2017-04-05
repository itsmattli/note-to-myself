<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function getImages() {

    }
    public function index() {
        return view('notes');
    }
}
