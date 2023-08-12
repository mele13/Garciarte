<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Image;

class ImageController extends Controller
{
    public function showUploadForm()
    {
        return view('partials/_uploadImage');
    }

    public function uploadImage(Request $request)
    {        
        \Log::info('Request received - upload file', [
            'name' => $request->hasFile('uploadfile'),
            // $filename = $$request->hasFile('uploadfile')->getClientOriginalName()
        ]);

        if ($request->hasFile('uploadfile')) {
            $file = $request->file('uploadfile');
            $filename = $file->getClientOriginalName();
            // $file->storeAs('private_images', $filename);
            $path = Storage::disk('private_images')->putFileAs('', $file, $filename);

            // dd($filename, $request->all());

            // Image::create([
            //     'filename' => $filename,
            // ]);

            return redirect()->back()->with('success', 'Image uploaded successfully.');
        }

        return redirect()->back()->with('error', 'No image selected.');
    }
}