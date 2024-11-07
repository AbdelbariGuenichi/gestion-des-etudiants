<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/welcome', function() {
        return view('welcome');
    })->name('welcome');
    Route::resource('/etudiants', EtudiantController::class);
    Route::resource('/matieres', controller: MatiereController::class);
    Route::resource('/notes', NoteController::class);
    Route::resource('/specialites', SpecialiteController::class);
    Route::resource('/villes', VilleController::class);
    Route::resource('/inscriptions', InscriptionController::class);
});
