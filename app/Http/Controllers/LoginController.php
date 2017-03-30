<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getCaptcha()
    {
        $img = new Securimage();

        // set namespace if supplied to script via HTTP GET
        if (!empty($_GET['namespace'])) $img->setNamespace($_GET['namespace']);

        $img->show();  // outputs the image and content headers to the browser
        // alternate use:
        // $img->show('/path/to/background_image.jpg');
    }
}
