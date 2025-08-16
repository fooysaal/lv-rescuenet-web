<?php

use App\Livewire\Authentication;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', Authentication::class);
Route::get('/login', Authentication::class)->name('login');
