<?php

namespace App\Policies\V1;


use App\Models\User;
use App\Permissions\V1\Abilities;
use Illuminate\Support\Facades\Auth;

class TransactionTypePolicy
{

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $authUser) {

        if ($authUser->tokenCan(Abilities::DeleteTransactionType)) {
            return true;
        }

        return false;
    }

    public function replace(User $authUser) {

        if ($authUser->tokenCan(Abilities::ReplaceTransactionType)){
            return true;
        }

        return false;
    }

    public function update(User $authUser) {

        if ($authUser->tokenCan(Abilities::UpdateTransactionType)){
            return true;
        }

        return false;
    }

    public function create(User $authUser) {

        if ($authUser->tokenCan(Abilities::CreateTransactionType)){
            return true;
        }

        return false;
    }
}
