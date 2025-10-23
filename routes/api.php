<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/token', [\App\Http\Controllers\TokenController::class, 'create'])->name('api.token.create');
Route::get('/contacts', [\App\Http\Controllers\Api\ContactsController::class, 'index'])->name('api.contacts.index');
Route::get('/events', [\App\Http\Controllers\Api\EventApiController::class, 'index'])->name('api.events.index');
