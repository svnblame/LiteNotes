<?php

use App\Http\Controllers\NotebookController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashedNoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Profiles
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notes
    Route::resource('notes', NoteController::class);
    Route::resource('notebooks', NotebookController::class);

    // Trash
    Route::get('/trash', [TrashedNoteController::class, 'index'])->name('trash.index');
    Route::get('/trash/{note}', [TrashedNoteController::class, 'show'])->name('trash.show')->withTrashed();
    Route::put('/trash/{note}', [TrashedNoteController::class, 'update'])->name('trash.update')->withTrashed();
});

require __DIR__.'/auth.php';
