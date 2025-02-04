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
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
        
        Gate::define('update-user', [UserPolicy::class, 'update']);
        Gate::define('replace-user', [UserPolicy::class, 'replace']);
        Gate::define('delete-user', [UserPolicy::class, 'delete']);

        Gate::define('update-category', [CategoryPolicy::class, 'update']);
        Gate::define('replace-category', [CategoryPolicy::class, 'replace']);
        Gate::define('create-category', [CategoryPolicy::class, 'create']);
        Gate::define('delete-category', [CategoryPolicy::class, 'delete']);

        Gate::define('update-transaction-type', [TransactionTypePolicy::class, 'update']);
        Gate::define('replace-transaction-type', [TransactionTypePolicy::class, 'replace']);
        Gate::define('create-transaction-type', [TransactionTypePolicy::class, 'create']);
        Gate::define('delete-transaction-type', [TransactionTypePolicy::class, 'delete']);
    }
}
