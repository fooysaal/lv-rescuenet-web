<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Api\BaseController;

class UserInfoController extends BaseController
{
    public function profile(Request $request): JsonResponse
    {
        $user = $request->user();
        return $this->sendResponse(new UserResource($user), 'User retrieved successfully.');
    }

    // public function updateProfile(Request $request): JsonResponse
    // {
    //     $user = $request->user();
    //     $user->update($request->all());
    //     return $this->sendResponse(new UserResource($user), 'User updated successfully.');
    // }
}
