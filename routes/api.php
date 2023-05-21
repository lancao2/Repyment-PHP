<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UsersController::class, "index"]);
Route::post('/users', [UsersController::class, "store"]);
Route::patch('/users/{id}', [UsersController::class, "update"]);
Route::delete('/users/{id}', [UsersController::class, "destroy"]);
