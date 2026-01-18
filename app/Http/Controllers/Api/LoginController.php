<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\BaseController;
use App\Models\UserInfo;
use Illuminate\Http\JsonResponse as JsonResponse;

class LoginController extends BaseController
{
    public function login(Request $request): JsonResponse
    {
        if (empty($request->loginId)) {
            return $this->sendError(
                'Validation Error.',
                ['identifier' => ['At least one of email, phone, or username is required.']]
            );
        }

        $user = User::where('email', $request->loginId)
            ->orWhere('phone', $request->loginId)
            ->orWhere('username', $request->loginId)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError('Invalid credentials', [], 401);
        }

        return response()->json([
            'message' => 'User logged in successfully',
            'user' => new UserResource($user),
            'hasLocationInfo' => $user->userInfo ? $user->userInfo->hasLocationInfo() : false,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logged out successfully',
        ]);
    }
}
