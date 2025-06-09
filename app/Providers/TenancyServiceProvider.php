<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

class TenancyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mapRoutes();
        $this->makeTenancyMiddlewareHighPriority();
    }

    protected function mapRoutes()
    {
        //
    }

    protected function makeTenancyMiddlewareHighPriority()
    {
        $middlewarePriority = config('tenancy.middleware_priority', []);
        
        foreach (array_reverse($middlewarePriority) as $middleware) {
            $this->app[\Illuminate\Contracts\Http\Kernel::class]
                ->prependToMiddlewarePriority($middleware);
        }
    }
}