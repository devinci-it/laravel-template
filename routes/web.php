<?php

use Illuminate\Support\Facades\Route;








Route::get('/terms-and-agreement', function () {
    return view('shared.terms');
})->name('page.terms');

Route::get('/', function () {
    return view('index');
});
