<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use Illuminate\Http\Request;

class DeviceTokenController extends Controller
{
    /**
     * Display a listing of the user's device tokens.
     */
    public function index()
    {
        $user = auth()->user();
        $tokens = $user->deviceTokens()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $tokens,
        ]);
    }

    /**
     * Store a newly created device token.
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'device_type' => 'nullable|string|in:ios,android,web',
            'device_name' => 'nullable|string',
        ]);

        $user = auth()->user();

        // Check if token already exists for this user
        $existingToken = $user->deviceTokens()
            ->where('token', $request->token)
            ->first();

        if ($existingToken) {
            // Update existing token
            $existingToken->update([
                'device_type' => $request->device_type ?? $existingToken->device_type,
                'device_name' => $request->device_name ?? $existingToken->device_name,
                'is_active' => true,
                'last_used_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Device token updated successfully',
                'data' => $existingToken,
            ]);
        }

        // Create new token
        $deviceToken = $user->deviceTokens()->create([
            'token' => $request->token,
            'device_type' => $request->device_type,
            'device_name' => $request->device_name,
            'is_active' => true,
            'last_used_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Device token registered successfully',
            'data' => $deviceToken,
        ], 201);
    }

    /**
     * Display the specified device token.
     */
    public function show(string $id)
    {
        $user = auth()->user();
        $token = $user->deviceTokens()->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $token,
        ]);
    }

    /**
     * Update the specified device token.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'device_type' => 'nullable|string|in:ios,android,web',
            'device_name' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $user = auth()->user();
        $token = $user->deviceTokens()->findOrFail($id);

        $token->update($request->only(['device_type', 'device_name', 'is_active']));

        return response()->json([
            'success' => true,
            'message' => 'Device token updated successfully',
            'data' => $token,
        ]);
    }

    /**
     * Remove the specified device token.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        $token = $user->deviceTokens()->findOrFail($id);
        $token->delete();

        return response()->json([
            'success' => true,
            'message' => 'Device token deleted successfully',
        ]);
    }

    /**
     * Deactivate a device token by token value.
     */
    public function deactivate(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $user = auth()->user();
        $deviceToken = $user->deviceTokens()
            ->where('token', $request->token)
            ->first();

        if (!$deviceToken) {
            return response()->json([
                'success' => false,
                'message' => 'Device token not found',
            ], 404);
        }

        $deviceToken->update(['is_active' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Device token deactivated successfully',
        ]);
    }
}
