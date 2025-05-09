<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users/{id}', [UserController::class, 'show']);
Route::get('/users/{id}/orders', [UserController::class, 'orders']);