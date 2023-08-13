<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/gestion')->group(function () {
    Route::view('', 'admin.adminView');
    // Route::view('/imagenes', 'admin.projectImages')->name('images.managerView');
    
    Route::get('/imagenes', [ImageController::class, 'index'])->name('images.showAll');
    Route::get('storage/private_images/{filename}', [ImageController::class, 'showImage'])->name('image.show');

    Route::get('/subir-imagen', [ImageController::class, 'showUploadForm'])->name('upload.showForm');
    Route::post('/subir-imagen', [ImageController::class, 'uploadImage'])->name('upload.image');
    // Route::get('/subir-imagen', [BoardController::class, 'destroy'])->name('boards.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
