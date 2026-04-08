<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [PortalController::class, 'showRegister']);
Route::post('/register', [PortalController::class, 'register']);
Route::get('/login', [PortalController::class, 'showLogin']);
Route::post('/login', [PortalController::class, 'login']);
Route::get('/logout', [PortalController::class, 'logout']);
Route::get('/dashboard', [PortalController::class, 'dashboard']);
Route::get('/profile/{id}', [PortalController::class, 'editProfile']);
Route::post('/profile/{id}', [PortalController::class, 'updateProfile']);
Route::post('/delete-user/{id}', [PortalController::class, 'deleteUser']);