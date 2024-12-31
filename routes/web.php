<?php

use App\Http\Controllers\NotebookController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashedNoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::middleware('auth')->group(function () {
    // Profiles
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notes
    Route::resource('notes', NoteController::class);
    Route::resource('notebooks', NotebookController::class);

    // Trash
    Route::prefix('trash')->name('trash.')->group(function () {
        Route::get('/', [TrashedNoteController::class, 'index'])->name('index');
        Route::get('/{note}', [TrashedNoteController::class, 'show'])->name('show')->withTrashed();
        Route::put('/{note}', [TrashedNoteController::class, 'update'])->name('update')->withTrashed();
        Route::delete('/{note}', [TrashedNoteController::class, 'destroy'])->name('destroy')->withTrashed();
    });
});

require __DIR__.'/auth.php';
