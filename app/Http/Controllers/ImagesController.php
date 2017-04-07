<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function create(Request $req) {
        $this->validate($req, [
            'image' => 'required|image|mimes:jpeg,jpg,gif|max:2048',

        ]);
    }
}
