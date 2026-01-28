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

        // check user role
        $userRole = $user->role;

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
            ->when($userRole === 'police', function ($query) {
                return $query->where('type', 'Police');
            })
            ->when($userRole === 'fire fighter', function ($query) {
                return $query->where('type', 'Fire');
            })
            ->when(in_array($userRole, ['member', 'ambulance service']), function ($query) {
                return $query->whereNotIn('type', ['Police']);
            })
            ->orderBy('distance', 'asc')       // closest first
            ->orderBy('created_at', 'desc')    // newest first
            ->with('user')
            ->get();

        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'is_verified' => $user->isVerified(),
                'has_emergency_contact' => $user->haveEmergencyContacts(),
            ],
            'data' => [
                'help_requests' => DashboardHelpRequestsResource::collection($helpRequests),
            ],
        ]);
    }
}
