<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index(): UserResource
    {
        $user = auth()->user();
        return new UserResource($user);
    }

    public function show($identify): UserResource
    {
        $user = $this->profileService->getUserByUUid($identify);

        $user->isProfile = true;
        return new UserResource($user);
    }

    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'link_indication' => 'string|max:255|unique:profiles',
        ],
        [
            'link_indication.unique' => 'Link já está em uso.',
        ]);

        $user = $this->profileService->updateUser($request->all());

        return response()->json(['data' => 'Dados atualizados com sucesso.'], 201);
    }

    public function highlightUser()
    {
        return UserResource::collection($this->profileService->highlightUser());
    }
}
