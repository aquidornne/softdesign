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

Route::get('/', [VueController::class, 'index']);

Route::get('/front', [VueController::class, 'index']);

Route::get('/weather', [HgbrasilController::class, 'weather']);

Route::resource('livros', LivroController::class);

Route::group(['prefix' => 'livros'], function () {
    /*
        Fugindo um pouco do padrão restfull neste caso pois estou utilizando datatable do
        bootstrap vue que necessita do envio de multiplos parâmetros.
    */
    Route::post('/index', [LivroController::class, 'index'])->name('livros.index');
    Route::post('/', [LivroController::class, 'store'])->name('livros.store');

    Route::group(['prefix' => '{id}'], function () {
        Route::get('/', [LivroController::class, 'show'])->name('livros.show');
        Route::put('/', [LivroController::class, 'update'])->name('livros.update');
        Route::delete('/', [LivroController::class, 'destroy'])->name('livros.destroy');
    });
});