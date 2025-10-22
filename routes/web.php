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
Route::get('events', [\App\Http\Controllers\BusinessEventController::class, 'index'])->middleware(['auth', 'verified'])->name('events');
Route::get('contacts/create', [\App\Http\Controllers\ContactsController::class, 'create'])->middleware(['auth', 'verified'])->name('contacts.create');
Route::get('contacts/{id}', [\App\Http\Controllers\ContactsController::class, 'edit'])->middleware(['auth', 'verified'])->name('contacts.edit');
Route::post('contacts', [\App\Http\Controllers\ContactsController::class, 'create'])->middleware(['auth', 'verified'])->name('contacts.store');
Route::post('contacts/{id}', [\App\Http\Controllers\ContactsController::class, 'update'])->middleware(['auth', 'verified'])->name('contacts.update');

require __DIR__.'/settings.php';
