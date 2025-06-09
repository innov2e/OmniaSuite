<?php

use Illuminate\Support\Facades\Route;

// Route solo per domini centrali
if (in_array(request()->getHost(), config('tenancy.central_domains', []))) {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/test', function () {
        return 'Laravel is working!';
    });
}