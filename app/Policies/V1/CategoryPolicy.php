<?php

namespace App\Policies\V1;


use App\Models\Category;
use App\Models\User;
use App\Permissions\V1\Abilities;
use Illuminate\Support\Facades\Auth;

class CategoryPolicy
{

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $authUser, Category $category) {

        if ($authUser->tokenCan(Abilities::DeleteCategory)){
            return true;
        }

        if ($authUser->tokenCan(Abilities::DeleteOwnCategory)){
            return $authUser->id === $category->user_id;
        }

        return false;
    }

    public function replace(User $authUser, Category $category) {

        if ($authUser->tokenCan(Abilities::ReplaceCategory)){
            return true;
        }

        if ($authUser->tokenCan(Abilities::ReplaceOwnCategory)){
            return $authUser->id === $category->user_id;
        }

        return false;
    }

    public function update(User $authUser, Category $category) {

        if ($authUser->tokenCan(Abilities::UpdateCategory)){
            return true;
        }

        if ($authUser->tokenCan(Abilities::UpdateOwnCategory)){
            return $authUser->id === $category->user_id;
        }

        return false;
    }

    public function create(User $authUser) {
        if ($authUser->tokenCan(Abilities::CreateCategory)){
            return true;
        }
        if ($authUser->tokenCan(Abilities::CreateOnwCategory)){
            return true;
        }
        return false;
    }
}
