<?php

namespace App\Policies\V1;

use App\Models\Transaction;
use App\Models\User;
use App\Permissions\V1\Abilities;

class TransactionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Transaction $transaction) {
        if ($user->tokenCan(Abilities::DeleteTransaction)) {
            return true;
        } else if ($user->tokenCan(Abilities::DeleteOwnTransaction)) {
            return $user->id === $transaction->user_id;
        }

        return false;
    }

    public function replace(User $user) {
        if ($user->tokenCan(Abilities::ReplaceTransaction)) {
            return true;
        }

        return false;
    }

    public function store(User $user) {
        return $user->tokenCan(Abilities::CreateTransaction) || $user->tokenCan(Abilities::CreateOwnTransaction);
    }

    public function update(User $user, Transaction $transaction) {
        if ($user->tokenCan(Abilities::UpdateTransaction)) {
            return true;
        } else if ($user->tokenCan(Abilities::UpdateOwnTransaction)) {
            return $user->id === $transaction->user_id;
        }

        return false;
    }
}
