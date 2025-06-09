<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenancyServiceProvider and are
| automatically scoped to the current tenant.
|
*/

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return 'This is tenant: ' . tenant('id');
    });
});