<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\UserHelpRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardHelpRequestsResource;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     * Invokable controller method.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ]);

        $lat = $request->query('latitude');
        $lng = $request->query('longitude');

        // Haversine formula (distance in KM)
        $helpRequests = UserHelpRequest::select('*')
            ->selectRaw(
                "(6371 * acos(
                    cos(radians(?)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?) ) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                )) AS distance",
                [$lat, $lng, $lat]
            )
            ->where('status', 'pending')
            ->where('user_id', '!=', $user->id)
            ->orderBy('distance', 'asc')       // closest first
            ->orderBy('created_at', 'desc')    // newest first
            ->with('user')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'is_verified' => $user->isVerified(),
                    'has_emergency_contact' => $user->haveEmergencyContacts(),
                ],
                'help_requests' => DashboardHelpRequestsResource::collection($helpRequests),
            ],
        ]);
    }
}
