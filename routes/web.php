<?php

use App\Http\Controllers\LandingController;
use App\Livewire\Authentication;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/about', [LandingController::class, 'about'])->name('about');

Route::get('/test', Authentication::class);
Route::get('/login', Authentication::class)->name('login');
