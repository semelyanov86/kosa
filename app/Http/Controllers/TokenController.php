<?php

namespace App\Http\Controllers;

use App\Data\AuthData;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class TokenController extends Controller
{
    public function create(LoginRequest $request): AuthData
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->string('password')->toString(), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return new AuthData(
            token: $user->createToken($request->string('device_name')->toString())->plainTextToken
        );
    }
}
