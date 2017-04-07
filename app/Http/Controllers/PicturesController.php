<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Picture;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;

class PicturesController extends Controller
{
    public function create(Request $req) {

        $images = Picture::where('user_ref', Auth::id())->count();
        if ($images >= 4) {
            Session::flash('error', "You are only allowed 4 images!");
            return redirect()->back();
        }

        $this->validate($req, [
            'image' => 'required|image|mimes:jpeg,jpg,gif|max:2048',
        ]);

        $image = Image::make(Input::file('image'));
        Response::make($image->encode('jpeg'));
        $picture = new Picture();
        $picture->user_ref = Auth::id();
        $picture->image = $image;
        $picture->save();

        return redirect()->back()->with("success", "Image is uploaded!");
    }
    public function get($id) {
        try {
            $picture = Picture::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with("error", "Image not found");
        }
        $pic = Image::make($picture->image);
        $response = Response::make($pic->encode('jpeg'));

        //setting content-type
        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }
}
