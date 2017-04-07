<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Provider\Image;
use App\Picture;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class PicturesController extends Controller
{
    public function create(Request $req) {

        $images = Image::where('user_ref', Auth::id())->count();
        if ($images >= 4) {
            Session::flash('error', "You are only allowed 4 images!");
            return redirect()->back();
        }

        $this->validate($req, [
            'image' => 'required|image|mimes:jpeg,jpg,gif|max:2048',
        ]);

        $file = Input::file('image');
        $image = Image::make($file);

        $picture = new Picture;
        $picture->name = $req->get('name');
        $picture->pic = $image;
        $picture->save();
    }
}
