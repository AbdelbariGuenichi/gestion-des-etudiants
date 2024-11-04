<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\InscriptionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('/etudiants', EtudiantController::class);
Route::resource('/matieres', MatiereController::class);
Route::resource('/notes', NoteController::class);
Route::resource('/specialites', SpecialiteController::class);
Route::resource('/villes', VilleController::class);
Route::resource('/inscriptions', InscriptionController::class);
Route::put('/inscriptions/{nci}', [InscriptionController::class, 'update'])->name('inscriptions.update');
