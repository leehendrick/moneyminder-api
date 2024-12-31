<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Models\User;
use App\Policies\V1\TransactionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Transaction::class => TransactionPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('update', function (User $user, Transaction $transaction) {
            return $transaction->user_id === $user->id;
        });
    }
}
