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

    public function updateProfile(Request $request): JsonResponse
    {
        $user = $request->user();
        $data = $request->only(['name', 'email', 'phone', 'username', 'profile_picture']);
        $request->validate([
                    'name' => 'sometimes|string|max:255',
                    'email' => 'sometimes|email|unique:users,email,' . $user->id,
                    'phone' => 'sometimes|string|max:20',
                    'username' => 'sometimes|string|max:255|unique:users,username,' . $user->id,
                    'profile_picture' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
                ]);

        // If profile picture is being updated
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }
        $user->update($data);

        return $this->sendResponse(new UserResource($user), 'User updated successfully.');
    }

    public function verifyProfile(Request $request): JsonResponse
    {
        $user = $request->user();

        $userInfo = $user->userInfo;
        if (!$userInfo) {
            return $this->sendError('User info not found.', [], 404);
        }

        // check if request body has nidfront
        $userInfo = $user->userInfo;
        $uploadedFiles = [];

        // Upload NID images if provided
        if ($request->hasFile('nid_front_image')) {
            $path = $request->file('nid_front_image')->store('nid/front', 'public');
            $userInfo->nid_front_image = $path;
            $uploadedFiles[] = 'nid_front_image';
        }

        if ($request->hasFile('nid_back_image')) {
            $path = $request->file('nid_back_image')->store('nid/back', 'public');
            $userInfo->nid_back_image = $path;
            $uploadedFiles[] = 'nid_back_image';
        }

        if ($request->hasFile('selfie_with_nid_image')) {
            $path = $request->file('selfie_with_nid_image')->store('nid/selfie', 'public');
            $userInfo->selfie_with_nid_image = $path;
            $uploadedFiles[] = 'selfie_with_nid_image';
        }

        if (!empty($uploadedFiles)) {
            $userInfo->nid_verification_status = 'verified';
            // update user role to volunteer
            $user->role = 'volunteer';
            $user->update();
            $userInfo->update();
        } else {
            return $this->sendError('No files uploaded for verification.', [], 400);
        }

        return $this->sendResponse(new UserResource($user), 'User profile verified successfully.');
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $user = $request->user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        // Check if current password matches
        if (!password_verify($request->input('current_password'), $user->password)) {
            return $this->sendError('Current password is incorrect.', [], 400);
        }

        // Update to new password
        $user->password = bcrypt($request->input('new_password'));
        $user->update();

        return $this->sendResponse(new UserResource($user), 'Password updated successfully.');
    }
}
