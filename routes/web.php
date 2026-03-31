<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Main Page';
});

Route::get('/hello', function () {
    return 'Hello';
})->name('hello'); // route name

// Redirect
Route::get('/hallo', function() {
    return redirect()->route('hello'); // Using route name
});

// Route with dynamic parameter
Route::get('/greet/{name}', function ($name) {
    return 'Hello ' . $name . '!';
});

// 404 Route
Route::fallback(function() {
    return 'Still got somewhere!';
});