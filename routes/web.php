<?php

use App\Http\Controllers\FonctionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

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
    return view('Auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('functions/delete/{id}', [FonctionController::class,"destroy"])->name("clients.destroy2");
    Route::view('about', 'about')->name('about');
    Route::resource('clients', ClientController::class);
    Route::post('clients', [ClientController::class,"saveClient"])->name("clients.save");
    
    Route::resource('functions', FonctionController::class,["names"=>"functions"]);
    Route::post('functions', [FonctionController::class,"saveFunction"])->name("functions.save");
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});