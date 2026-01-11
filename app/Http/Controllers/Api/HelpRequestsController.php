<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HelpRequestsResource;
use App\Models\UserHelpRequest;

class HelpRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $requests = $user->helpRequests()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => [
                'help_requests' => HelpRequestsResource::collection($requests),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'location_name' => 'nullable|string',
            'files.*' => 'nullable|file|max:30720', // max 30MB
        ]);

        $user = auth()->user();

        $helpRequest = new UserHelpRequest();
        $helpRequest->user_id = $user->id;
        $helpRequest->type = $request->type;
        $helpRequest->description = $request->description;
        $helpRequest->latitude = $request->latitude;
        $helpRequest->longitude = $request->longitude;
        $helpRequest->location_name = $request->location_name;
        $helpRequest->status = 'pending';
        $helpRequest->save();

        // Fix: Check if files exist and iterate properly
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            // Handle both single file and array of files
            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $file) {
                $path = $file->store('help_request_files', 'public');
                $helpRequest->files()->create([
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'data' => new HelpRequestsResource($helpRequest),
            'message' => 'Help request created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = auth()->user();

        $helpRequest = $user->helpRequests()->with('files')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => new HelpRequestsResource($helpRequest),
            'message' => 'Help request retrieved successfully',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
