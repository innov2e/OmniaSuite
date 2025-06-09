<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

// Applica il middleware solo se NON siamo su un dominio centrale
Route::middleware([
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        // Se siamo qui, il tenant è inizializzato
        return 'This is tenant: ' . tenant('id') . ' (' . tenant('name') . ')';
    })->name('tenant.home');

    Route::get('/dashboard', function () {
        return 'Tenant Dashboard for: ' . tenant('name');
    })->name('tenant.dashboard');
});