<?php

namespace App\Http\Controllers;
use App\Note;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class NotesController extends Controller
{
    public function update(Request $req) {
        $note = Note::where('user_ref', Auth::id())->first();
        if(!$note) {
            $note = new Note;
            $note->user_ref = Auth::id();
        }
        $note->note = $req->note;

        try {
            $note->save();
        } catch (QueryException $e) {
            Session::flash('error', "Could not edit note, please try again");
            return redirect()->back();
        }
        Session::flash('active', 'note');
        return redirect()->back();
    }
}
