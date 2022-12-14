<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function store(Request $request){
        $path = public_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('image');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return ['name'=>$name];
    }

    public function getImages(Images $post){
        $images = $post->images;
        return ['images'=>$images];
    }

}
