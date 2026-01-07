<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\JsonResponse as JsonResponse;

class AuthenticationController extends BaseController
{
    public function login(Request $request): JsonResponse
    {
        if(empty($request->loginId)) {
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
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }

    // public function register(Request $request): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'nullable|email|unique:users,email',
    //         'phone' => 'nullable|min:11|unique:users,phone',
    //         'username' => 'required|unique:users,username',
    //         'password' => 'required|string|min:6|confirmed',
    //         'gender' => 'required|string|in:male,female,other',
    //         'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     if($validator->fails()){
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     }

    //     if (empty($request->email) && empty($request->phone)) {
    //         return $this->sendError(
    //         'Validation Error.',
    //         ['identifier' => ['At least one of email or phone is required.']]
    //         );
    //     }

    //     $user = User::create([
    //         'role' => $request->role,
    //         'name' => $request->name,
    //         'email' => $request->email ?? null,
    //         'phone' => $request->phone ?? null,
    //         'username' => $request->username,
    //         'profile_picture' => $request->profile_picture ?? null,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     return response()->json([
    //         'message' => 'User registered successfully',
    //         'user' => new UserResource($user),
    //         'token' => $user->createToken('auth_token')->plainTextToken,
    //     ]);
    // }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logged out successfully',
        ]);
    }
}
