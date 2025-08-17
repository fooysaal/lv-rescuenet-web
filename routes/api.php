<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Livewire\Authentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
});
