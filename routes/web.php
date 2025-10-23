<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', [\App\Http\Controllers\ContactsController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified'])->name('contacts.')->group(function () {
    Route::get('contacts/create', [\App\Http\Controllers\ContactsController::class, 'create'])->name('create');
    Route::get('contacts/{id}', [\App\Http\Controllers\ContactsController::class, 'edit'])->name('edit');
    Route::post('contacts', [\App\Http\Controllers\ContactsController::class, 'store'])->name('store');
    Route::post('contacts/{id}', [\App\Http\Controllers\ContactsController::class, 'update'])->name('update');
    Route::delete('contacts/{contact}', [\App\Http\Controllers\ContactsController::class, 'delete'])->name('delete');
});
Route::middleware(['auth', 'verified'])->name('events.')->prefix('events')->group(function () {
    Route::get('/', [\App\Http\Controllers\BusinessEventController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\BusinessEventController::class, 'create'])->name('create');
    Route::get('/{id}', [\App\Http\Controllers\BusinessEventController::class, 'edit'])->name('edit');
    Route::delete('/{event}', [\App\Http\Controllers\BusinessEventController::class, 'delete'])->name('delete');
    Route::post('/', [\App\Http\Controllers\BusinessEventController::class, 'store'])->name('store');
    Route::post('/{id}', [\App\Http\Controllers\BusinessEventController::class, 'update'])->name('update');
});

require __DIR__.'/settings.php';
