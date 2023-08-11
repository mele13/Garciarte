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
    Route::view('/imagenes', 'admin.projectImages');

    Route::match(['get', 'post'], '/subir-imagen', [ImageController::class, 'showUploadForm']);
    // Route::get('/subir-imagen', [BoardController::class, 'destroy'])->name('boards.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
