<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\RegistrationStep1Request;
use App\Http\Requests\RegistrationStep2Request;
use App\Http\Requests\RegistrationStep3Request;

class RegistrationController extends Controller
{
    /**
     * Step 1: Create user with basic information
     * Collects: fullName, gender, mobile, email, password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function step1(RegistrationStep1Request $request)
    {
        try {
            DB::beginTransaction();
            // Create user with pending status
            $user = User::create([
                'name' => $request->name,
                'gender' => $request->gender,
                'phone' => $request->phone ?? null,
                'email' => $request->email ?? null,
                'password' => Hash::make($request->password),
                'role' => 'member',
                'registration_status' => 'step1_completed',
                'current_registration_step' => 2,
            ]);

            // Generate registration token
            $token = $user->generateRegistrationToken();

            // Create empty user_info record
            UserInfo::create([
                'user_id' => $user->id,
            ]);

            // Create sanctum token for API authentication
            $authToken = $user->createToken('auth_token')->plainTextToken;

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Step 1 completed successfully',
                'data' => [
                    'user_id' => $user->id,
                    'registration_token' => $token,
                    'auth_token' => $authToken,
                    'current_step' => 2,
                    'token_expires_at' => $user->registration_token_expires_at->toISOString(),
                ],
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Step 2: Upload NID verification images (optional)
     * Collects: nidFrontImage, nidBackImage, selfieWithNidImage
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function step2(RegistrationStep2Request $request)
    {
        try {
            // Find user and validate token
            $user = User::find($request->user_id);

            if (!$user->hasValidRegistrationToken() || $user->registration_token !== $request->registration_token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired registration token',
                ], 401);
            }

            DB::beginTransaction();

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

            if(!empty($uploadedFiles)) {
                $userInfo->nid_verification_status = 'verified';
            }

            // Update user registration status
            $user->registration_status = 'step2_completed';
            $user->current_registration_step = 3;
            $user->save();

            $userInfo->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Step 2 completed successfully',
                'data' => [
                    'user_id' => $user->id,
                    'uploaded_files' => $uploadedFiles,
                    'current_step' => 3,
                    'skipped' => empty($uploadedFiles),
                ],
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Step 2 failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Step 3: Add location and complete registration
     * Collects: latitude, longitude, location
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function step3(RegistrationStep3Request $request)
    {
        try {
            // Find user and validate token
            $user = User::find($request->user_id);

            if (!$user->hasValidRegistrationToken() || $user->registration_token !== $request->registration_token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired registration token',
                ], 401);
            }

            DB::beginTransaction();

            // Update location information
            $userInfo = $user->userInfo;
            $userInfo->latitude = $request->latitude;
            $userInfo->longitude = $request->longitude;
            $userInfo->location_name = $request->location;
            $userInfo->location_updated_at = now();
            $userInfo->save();

            // Complete registration
            $user->registration_status = 'completed';
            $user->current_registration_step = 3;
            $user->registration_completed_at = now();
            $user->registration_token = null; // Clear token after completion
            $user->registration_token_expires_at = null;
            $user->save();

            // Save emergency contact
            $user->emergencyContacts()->create([
                'user_id' => $user->id,
                'name' => $request->name,
                'relationship' => $request->relationship,
                'phone' => $request->phone,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registration completed successfully',
                'data' => [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'registration_completed_at' => $user->registration_completed_at->toISOString(),
                ],
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Step 3 failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Skip Step 2 (NID verification)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function skipStep2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'registration_token' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $user = User::find($request->user_id);

            if (!$user->hasValidRegistrationToken() || $user->registration_token !== $request->registration_token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired registration token',
                ], 401);
            }

            // Update user to skip step 2
            $user->registration_status = 'step2_completed';
            $user->current_registration_step = 3;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Step 2 skipped',
                'data' => [
                    'user_id' => $user->id,
                    'current_step' => 3,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to skip step 2',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get current registration status
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRegistrationStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::with('userInfo')->find($request->user_id);

        return response()->json([
            'success' => true,
            'data' => [
                'user_id' => $user->id,
                'registration_status' => $user->registration_status,
                'current_step' => $user->current_registration_step,
                'registration_completed' => $user->hasCompletedRegistration(),
                'token_valid' => $user->hasValidRegistrationToken(),
                'has_nid_images' => $user->userInfo->hasNIDImages(),
            ],
        ], 200);
    }
}
