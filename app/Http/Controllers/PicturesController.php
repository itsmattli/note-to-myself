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
use Illuminate\Support\Facades\Validator;

class PicturesController extends Controller
{
    public function create(Request $req) {
        Session::flash("active", "picture");
        if(!isset($req->image)) {
            return redirect()->back()->with("error", "No image was selected");
        }

        $validator = Validator::make($req->all(), ['image' => 'required|image|mimes:jpeg,jpg,gif|max:2048']);
        if($validator->fails()) {
            return redirect()->back()->with("error", "Image upload requirements not met, try a different image");
        }

        $images = Picture::where('user_ref', Auth::id())->count();
        if ($images >= 4) {
            return redirect()->back()->with("error", "You are only allowed 4 images!" );
        }

        $image = Image::make(Input::file('image'));
        Response::make($image->encode('jpeg'));
        $picture = new Picture();
        $picture->user_ref = Auth::id();
        $picture->image = $image;
        $picture->save();
        return redirect()->back()->with("success", "Image is uploaded!");
    }

    public function delete(Request $req) {
        Session::flash("active", "picture");
        try {
            $picture = Picture::findOrFail($req->id);
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with("error", "Image to be deleted could not be found, please try again.");
        }
        $picture->delete();
        return redirect()->back()->with("success", "Image was deleted!");
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
