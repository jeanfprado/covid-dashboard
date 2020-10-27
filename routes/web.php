<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportFileController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', function(){
    return view('about');
})->name('about');

//temp
Route::get('/import', [ImportFileController::class, 'create'])->name('import.create');
Route::post('/import', [ImportFileController::class, 'store'])->name('import.store');
