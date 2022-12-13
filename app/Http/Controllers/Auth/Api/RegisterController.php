<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function verifylink(Request $request)
    {
        $user = User::with('profile', function ($query) use ($request) {
            return $query->where('link_indication', $request->link);
        })->first();

        return new UserResource($user);
    }

    public function register (Request $request, User $user): JsonResponse
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'email' => 'required|string|email|max:255|unique:users'
        ]);

        $userData = $request->only('name', 'email', 'password');
        $userData['password'] = Hash::make($userData['password']);
        $userData['token_verify'] = generateToken();
        $userData['token_validate'] = Carbon::now()->addHours(24);

        if(!$user = $user->create($userData))
            abort(403, 'Erro ao criar novo usuário.');

        $credentials = [
            'email' => $user->email,
            'password' => $request->password,
        ];

        if(!auth()->attempt($credentials))
            abort(401, 'Credenciais inválidas.');

        $token = auth()->user()?->createToken($user->id);

        event(new Registered($user));
        return response()
            ->json([
                'data' => [
                    'token' => $token->plainTextToken,
                ],
            ]);
    }
}
