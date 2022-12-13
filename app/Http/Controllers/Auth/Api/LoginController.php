<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MeResource;
use App\Mail\SendMailRecoverPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login (Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if(!auth()->attempt($credentials))
            abort(401, 'Invalid Credentials.');

        $token = auth()->user()->createToken(auth()->id());

        return response()
                ->json([
                    'data' => [
                        'token' => $token->plainTextToken,
                    ],
                ]);
    }

    public function me(): MeResource
    {
        $user = User::with('profile')->find(auth()->id());
        return new MeResource($user);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([], 204);
    }

    public function retrySendMailVerification()
    {
        if(auth()->user()->token_validate > Carbon::now())
            abort(403, 'Você já possui um token válido.');

        auth()->user()->token_verify = generateToken();
        auth()->user()->token_validate = Carbon::now()->addHours(24);
        auth()->user()?->save();
        auth()->user()?->sendEmailVerificationNotification();
    }

    public function verifyTokenRegister(Request $request): JsonResponse
    {
        if(auth()->user()?->hasVerifiedEmail()){
            abort(403, 'Usuário já verificado.');
        }

        if (auth()->user()->token_verify !== $request->token) {
            abort(404, 'Token Inválido.');
        }

        if (auth()->user()->token_validate < Carbon::now()) {
            abort(422, 'Token Expirado.');
        }

        auth()->user()?->markEmailAsVerified();

        return response()->json(['message' => 'Token verificado.'], 200);
    }

    public function recoverPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255'
        ]);
        $user = User::where('email', $request->email)->first();

        if(!$user){
            abort(404, 'Usuário não encontrado.');
        }

        $userData = $request->only('email');
        $userData['token_verify'] = generateToken();
        $userData['token_validate'] = Carbon::now()->addMinutes(60);
        $userData['email_verified_at'] = Carbon::now();

        $user->update($userData);
        Mail::to($user->email)->send(new SendMailRecoverPassword($user));

        return response()->json(['data' => 'E-mail enviado'], 200);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'email' => 'required|string|email|max:255'
        ]);

        $user = User::where('email', $request->email)->first();

        if($user->token_verify !== $request->token){
            abort(404, 'Token Inválido.');
        }

        if($user->token_validate < Carbon::now()){
            abort(422, 'Token Expirado.');
        }

        $userData = $request->only('name', 'email', 'password');
        $userData['password'] = Hash::make($userData['password']);
        $userData['email_verified_at'] = Carbon::now();
        $user->update($userData);

        return response()->json(['message' => 'Senha alterada.'], 200);
    }
}
