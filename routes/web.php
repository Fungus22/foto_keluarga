<?php

use Illuminate\Support\Facades\Route;
// mengkoneksikan antara route dan controller
use App\Http\Controllers\FotoController;
use App\Http\Controllers\AlbumController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//digunakan untuk membuat rute resource controller secara otomatis
// mencakup CRUD
Route::resource("/foto", FotoController::class);

Route::resource("/album", AlbumController::class);