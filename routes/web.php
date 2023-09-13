<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VueController;
use App\Http\Controllers\HgbrasilController;
use App\Http\Controllers\LivroController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/front', [VueController::class, 'index']);

Route::get('/weather', [HgbrasilController::class, 'weather']);

Route::resource('livros', LivroController::class);