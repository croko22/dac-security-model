<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::middleware(['auth'])->group(function () {
    Route::resource('notes', NoteController::class);
    Route::get('/', [NoteController::class, 'index'])->name('notes.index');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');


    Route::post('notes/{note}/share', [NoteController::class, 'share'])->name('notes.share');
    Route::post('notes/{note}/revoke', [NoteController::class, 'revoke'])->name('notes.revoke');

    Log::info('Auth routes loaded');
});

Route::middleware(['guest'])->group(function () {
    Route::view('/', 'auth.login')->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login');

    Log::info('Guest routes loaded');
});