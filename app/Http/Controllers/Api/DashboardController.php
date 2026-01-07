<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HelpRequestsResource;
use App\Models\UserHelpRequest;
use PHPUnit\Metadata\Uses;

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
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
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
            ->orderBy('distance', 'asc')       // closest first
            ->orderBy('created_at', 'desc')    // newest first
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
                'help_requests' => HelpRequestsResource::collection($helpRequests),
            ],
        ]);
    }
}
