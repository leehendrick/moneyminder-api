<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Resources\V1\UserResource;
use App\Permissions\V1\Abilities;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    use ApiResponses;

    public function login(ApiLoginRequest $request) {
        $request->validated();

        if(!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalid credentials', 401);
        }

        $user = User::firstWhere('email', $request->email);

        return $this->ok(
            'Authenticated',
            [
                'token' => $user->createToken(
                    'API token for ' . $user->email,
                    Abilities::getAbilities($user),
                    now()->addMonth())->plainTextToken,
            ]
        );
    }

    public function register(StoreUserRequest $request) {
        try {
            $user = User::create($request->mappedAttributes());
            return $this->ok('User created');
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), 200);
        }
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return $this->ok('');
    }
}

