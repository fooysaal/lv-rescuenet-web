<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserInfo;

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
            'phone' => 'required|string|max:11',
            'relationship' => 'nullable|string|max:20',
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
        ]);

        $lat = $request->latitude;
        $lng = $request->longitude;
        $radius = $request->radius_km ?? 1; // default 1 km

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
            ->with('user')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'volunteers' => $volunteers,
            ],
        ]);
    }
}
