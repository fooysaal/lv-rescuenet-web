<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Models\UserHelpRequestLog;
use App\Http\Controllers\Controller;
use App\Models\UserRequestFlagReport;

class MoreServiceController extends Controller
{
    public function emergencyContacts()
    {
        $user = auth()->user();

        return response()->json([
            'status' => 'success',
            'data' => [
                'emergency_contacts' => $user->emergencyContacts,
            ],
        ]);
    }

    public function addEmergencyContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:11|max:15',
            'relationship' => 'nullable|string|max:100',
        ]);

        $user = auth()->user();

        $emergencyContact = $user->emergencyContacts()->create([
            'name' => $request->name,
            'phone' => $request->phone,
            'relationship' => $request->relationship,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => [
                'emergency_contact' => $emergencyContact,
            ],
        ], 201);
    }

    public function deleteEmergencyContact($id)
    {
        $user = auth()->user();

        $emergencyContact = $user->emergencyContacts()->findOrFail($id);
        $emergencyContact->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Emergency contact deleted successfully',
        ]);
    }

    public function nearByVolunteers(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius_km' => 'nullable|numeric',
            'role' => 'nullable|string',
        ]);

        $lat = $request->latitude;
        $lng = $request->longitude;
        $radius = $request->radius_km ?? 1; // default 1 km
        $role = $request->role ?? 'volunteer';

        // Haversine formula to find nearby volunteers
        $volunteers = UserInfo::select('*')
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
            ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc')
            ->whereNotIn('user_id', [auth()->id()])
            ->whereHas('user', function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->with('user')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'volunteers' => $volunteers,
            ],
        ]);
    }

    public function userOverview($id)
    {
        $user = User::findOrFail($id);

        // 1. Registered Since
        $registeredSince = $user->created_at;

        // 2. Total Requests Made
        $totalRequestsMade = $user->helpRequests()->count();

        // 3. Total Respond to others (unique help_request_id where performed_by is this user)
        $totalRespondToOthers = UserHelpRequestLog::where('performed_by', $user->id)
            ->distinct('help_request_id')
            ->count('help_request_id');

        // 4. Reported requests own (unique user_help_request_id from user_request_flag_reports where user_help_request_id belongs to this user's requests)
        $userRequestIds = $user->helpRequests()->pluck('id');
        $reportedRequestsOwn = UserRequestFlagReport::whereIn('user_help_request_id', $userRequestIds)
            ->distinct('user_help_request_id')
            ->count('user_help_request_id');

        // 5. Last three help requests with logs
        $lastThreeHelpRequests = $user->helpRequests()
            ->with(['requestLogs.performedBy', 'files'])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'user_overview' => [
                    'registered_since' => $registeredSince,
                    'total_requests_made' => $totalRequestsMade,
                    'total_respond_to_others' => $totalRespondToOthers,
                    'reported_requests_own' => $reportedRequestsOwn,
                ],
                'last_three_help_requests' => $lastThreeHelpRequests,
            ],
        ]);
    }
}
