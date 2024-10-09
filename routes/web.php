<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // routes/web.php
    Route::resource('notes', NoteController::class);

    Route::post('notes/{note}/share', [NoteController::class, 'share'])->name('notes.share');
    Route::post('notes/{note}/revoke', [NoteController::class, 'revoke'])->name('notes.revoke');

});

Route::middleware(['guest'])->group(function () {
    Route::view('/', 'auth.login')->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login');
});