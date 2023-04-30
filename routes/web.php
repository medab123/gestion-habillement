<?php

use App\Http\Controllers\CouleurController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\LivrisionController;
use App\Http\Controllers\TailleurController;
use App\Http\Controllers\TypeProduitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\VetementController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('functions/delete/{id}', [FonctionController::class,"destroy"])->name("functions.destroy2");
    Route::get('clients/delete/{id}', [ClientController::class,"destroy"])->name("clients.destroy2");
    Route::get('fournisseurs/delete/{id}', [FournisseurController::class,"destroy"])->name("fournisseurs.destroy2");
    Route::resource('fournisseurs', FournisseurController::class);
    Route::post('fournisseurs', [FournisseurController::class,"saveFournisseur"])->name("fournisseurs.save");

    Route::get('typeProduits/delete/{id}', [TypeProduitController::class,"destroy"])->name("typeProduits.destroy2");
    Route::resource('typeProduits', TypeProduitController::class);
    Route::post('typeProduits', [TypeProduitController::class,"saveTypeProduit"])->name("typeProduits.save");


    Route::view('about', 'about')->name('about');
    Route::resource('clients', ClientController::class);
    Route::post('clients', [ClientController::class,"saveClient"])->name("clients.save");

    Route::get('vetements/delete/{id}', [VetementController::class,"destroy"])->name("vetements.destroy2");
    Route::resource('vetements', VetementController::class);
    Route::post('vetements', [VetementController::class,"saveVetement"])->name("vetements.save");

    Route::get('tailleurs/delete/{id}', [TailleurController::class,"destroy"])->name("tailleurs.destroy2");
    Route::resource('tailleurs', TailleurController::class);
    Route::post('tailleurs', [TailleurController::class,"saveTailleur"])->name("tailleurs.save");

    Route::get('couleurs/delete/{id}', [CouleurController::class,"destroy"])->name("couleurs.destroy2");
    Route::resource('couleurs', CouleurController::class);
    Route::post('couleurs', [CouleurController::class,"saveCouleur"])->name("couleurs.save");

    Route::resource('functions', FonctionController::class,["names"=>"functions"]);
    Route::post('functions', [FonctionController::class,"saveFunction"])->name("functions.save");
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get("commandes",[CommandeController::class,"index"])->name("commandes.index");
    Route::post('commandes', [CommandeController::class,"saveCommande"])->name("commandes.save");
    Route::get('commandes/{id}', [CommandeController::class,"show"])->name("commandes.show");

    Route::get("livrisions",[LivrisionController::class,"index"])->name("livrisions.index");
    Route::post('livrisions', [LivrisionController::class,"savelivrision"])->name("livrisions.save");
    Route::get('livrisions/{id}', [LivrisionController::class,"show"])->name("livrisions.show");

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
