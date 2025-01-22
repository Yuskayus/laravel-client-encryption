<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientCashController;

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/client/{encryptedId}', [ClientController::class, 'show'])->name('clients.show');
// Route::get('/clients/{id}/details', [ClientController::class, 'showDetails'])->name('clients.details');
Route::get('/client/{encryptedId}/details', [ClientController::class, 'showDetails'])->name('clients.details');

Route::get('/client-cash', [ClientCashController::class, 'getClientCash']);

