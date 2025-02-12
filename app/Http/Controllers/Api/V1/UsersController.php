<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\UserFilter;
use App\Http\Requests\Api\V1\ReplaceUserRequest;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UsersController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserFilter $filters)
    {
        return  UserResource::collection(User::filter($filters)->paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create($request->mappedAttributes());
            return new  UserResource($user);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), 200);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if($this->include('transactions')) {
            return new UserResource($user->load('transactions'));
        }
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (Gate::allows('update-user', $user)) {
            $user->update($request->mappedAttributes());
            return  new UserResource($user);
        }
        return $this->notAuthorized('You are not allowed to update this user.');

    }

    public function replace(ReplaceUserRequest $request, User $user)
    {
        if (!Gate::allows('replace-user', $user)) {
            return $this->notAuthorized('You are not allowed to replace this user.');
        }

        $user->update($request->mappedAttributes());
        return  new UserResource($user);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!Gate::allows('delete-user', $user)) {
            return $this->notAuthorized('You are not allowed to delete this user.');
        }
        $user->delete();
        return $this->ok('User was successfully deleted.');
    }
}
