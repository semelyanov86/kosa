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

require __DIR__.'/settings.php';
