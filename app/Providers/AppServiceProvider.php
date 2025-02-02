<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Policies\V1\UserPolicy;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('update', [UserPolicy::class, 'update']);
        Gate::define('replace', [UserPolicy::class, 'replace']);
        Gate::define('delete', [UserPolicy::class, 'delete']);
    }
}
