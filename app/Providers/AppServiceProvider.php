<?php

namespace App\Providers;


use App\Policies\V1\CategoryPolicy;
use App\Policies\V1\TransactionTypePolicy;
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

        Gate::define('update', [CategoryPolicy::class, 'update']);
        Gate::define('replace', [CategoryPolicy::class, 'replace']);
        Gate::define('create', [CategoryPolicy::class, 'create']);
        Gate::define('delete', [CategoryPolicy::class, 'delete']);

        Gate::define('update', [TransactionTypePolicy::class, 'update']);
        Gate::define('replace', [TransactionTypePolicy::class, 'replace']);
        Gate::define('create', [TransactionTypePolicy::class, 'create']);
        Gate::define('delete', [TransactionTypePolicy::class, 'delete']);
    }
}
