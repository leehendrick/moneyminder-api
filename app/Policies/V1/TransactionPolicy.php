<?php

namespace App\Policies\V1;

use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(Transaction $transaction, User $user)
    {
        return $transaction->user_id === $user->id;
    }
}
