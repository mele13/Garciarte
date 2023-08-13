<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Response;

use App\Models\Image;

class ImageController extends Controller
{
    protected $privateImagesPath;

    public function __construct()
    {
        $this->privateImagesPath = Storage::disk('private_images');
    }
    
    public function index()
    {
        $images = Image::all();

        return view('admin.projectImages', ['images' => $images]);
    }

    public function showImage($filename)
    {
        $filePath = Storage::disk('private_images')->path($filename);
        
        return response()->file($filePath);
    }

    public function showUploadForm()
    {
        return view('partials/_uploadImage');
    }

    public function uploadImage(Request $request)
    {
        $uploadedImagesInfo = $this->processUploadedImages($request);

        return redirect()->back()->with($uploadedImagesInfo);
    }

    /*
    -----------------------------------------------------------------------------------
    ------------------------------- Protected functions ------------------------------- 
    -----------------------------------------------------------------------------------
    */

    protected function processUploadedImages(Request $request)
    {
        $totalImages = 0;
        $uploadedImages = 0;
        $duplicateImages = 0;
        $duplicateImageNames = [];

        if (!$request->hasFile('uploadfiles')) {
            return ['errorMessage' => 'No se seleccionaron imágenes'];
        }

        $files = $request->file('uploadfiles');

        foreach ($files as $file) {
            $totalImages++;

            $hash = hash_file('sha256', $file->getRealPath());
            $existingImage = Image::where('hash', $hash)->first();

            if ($existingImage) {
                $duplicateImages++;
                $duplicateImageNames[] = $file->getClientOriginalName();
            } else {
                $filename = $this->generateUniqueFilename($file->getClientOriginalName());
                $this->privateImagesPath->putFileAs('', $file, $filename);

                Image::create([
                    'filename' => $filename,
                    'hash' => $hash,
                ]);

                $uploadedImages++;
            }
        }

        $successMessage = '';
        $errorMessage = '';

        if ($uploadedImages > 0) {
            $successMessage = "Se ha" . ($uploadedImages > 1 ? 'n' : '') . " cargado $uploadedImages imagen" . ($uploadedImages > 1 ? 'es' : '') . " con éxito";
        }

        if ($duplicateImages > 0) {
            $errorMessage = " $duplicateImages imagen" . ($duplicateImages > 1 ? 'es' : '') . " duplicada" . ($duplicateImages > 1 ? 's' : '') . " encontrada" . ($duplicateImages > 1 ? 's' : '') . ": " . implode(', ', $duplicateImageNames);
        }

        return ['successMessage' => $successMessage, 'errorMessage' => $errorMessage];
    }

    protected function generateUniqueFilename($originalFilename)
    {
        $timestamp = now()->format('Y-m-d_H-i-s'); // Format: Year-Month-Day_Hour-Minute-Second
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
        $basename = pathinfo($originalFilename, PATHINFO_FILENAME);
        $newFilename = $basename . '_' . $timestamp . '.' . $extension;

        return $newFilename;
    }
}

