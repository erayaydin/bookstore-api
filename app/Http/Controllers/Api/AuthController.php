<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthGetTokenRequest;
use App\Http\Requests\Api\AuthRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;

class AuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function getToken(AuthGetTokenRequest $request): array
    {
        /** @var User|null $user */
        $user = User::query()->where('email', $request->get('email'))->first();
        if (! $user || ! Hash::check($request->get('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return [
            'access_token' => $user->createToken($request->get('device_name'))->plainTextToken,
            'user' => new UserResource($user),
        ];
    }

    public function register(AuthRegisterRequest $request): array
    {
        User::query()->create($request->only('name', 'email') + ['password' => bcrypt($request->get('password'))]);

        return [
            'status' => "ok",
        ];
    }

    public function me(): UserResource
    {
        return new UserResource(auth()->user());
    }
}
