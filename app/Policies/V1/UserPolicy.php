<?php

namespace App\Policies\V1;


use App\Models\User;
use App\Permissions\V1\Abilities;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    //TODO Refactorar, não repetir a verificação do usuário logado
    /**
    public function isLoggedIn()
    {
        if (Auth::check()) {
            return $auth = Auth::user();
        }
            return false;
    }*/

    public function delete(User $authUser, User $user) {

        if ($authUser->tokenCan(Abilities::DeleteUser)){
            return true;
        }

        if ($authUser->tokenCan(Abilities::DeleteOwnUser)){
            return $authUser->id === $user->id;
        }

        return false;
    }

    public function replace(User $authUser, User $user) {

        if ($authUser->tokenCan(Abilities::ReplaceUser)){
            return true;
        }

        if ($authUser->tokenCan(Abilities::ReplaceOwnUser)){
            return $authUser->id === $user->id;
        }

        return false;
    }

    public function update(User $authUser, User $user) {

        if ($authUser->tokenCan(Abilities::UpdateUser)){
            return true;
        }

        if ($authUser->tokenCan(Abilities::UpdateOwnUser)){
            return $authUser->id === $user->id;
        }

        return false;
    }
}
