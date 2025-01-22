<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/client/{encryptedId}', [ClientController::class, 'show'])->name('clients.show');
