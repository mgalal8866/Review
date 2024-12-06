<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Service;
use App\Models\Store;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'service' => Service::class,
            'product' => Product::class,
            'store'   => Store::class,
        ]);
    }
}
