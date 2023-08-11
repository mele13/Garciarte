<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function showUploadForm()
    {
        return view('partials/_uploadImage');
    }

    public function uploadImage(Request $request)
    {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('private_images', $imageName);

        return back()->with('success', 'Image uploaded successfully.');
    }
}
