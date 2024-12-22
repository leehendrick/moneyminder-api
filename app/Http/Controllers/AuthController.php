<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiLoginRequest;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    use ApiResponses;

    public function login(ApiLoginRequest $request) {
        $request->validated();

        if(!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalide credentials', 401);
        }

        $user = User::firstWhere('email', $request->email);

        return $this->ok(
            'Authenticated',
            [
                'token' => $user->createToken('API token for ' . $user->email)->plainTextToken,
            ]
        );
    }

    public function register() {

    }
}

