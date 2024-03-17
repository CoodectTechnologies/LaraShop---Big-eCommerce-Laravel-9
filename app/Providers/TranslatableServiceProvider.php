<?php

namespace App\Providers;

use App\Models\Banner;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Spatie\Translatable\Facades\Translatable;

class TranslatableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Translatable::fallback(
            fallbackLocale: config('translatable.fallback'),
            fallbackAny: true
        );
    }
}
