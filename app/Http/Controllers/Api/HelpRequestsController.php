<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\UserHelpRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailHelpRequestsResource;
use App\Services\NotificationService;
use App\Http\Resources\HelpRequestsResource;

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
        $helpRequest = UserHelpRequest::with('files', 'user', 'requestLogs', 'flagReports')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => new DetailHelpRequestsResource($helpRequest),
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
        $user = auth()->user();
        $helpRequest = UserHelpRequest::findOrFail($id);

        // check if the help request belongs to the authenticated user
        if ($helpRequest->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to update this help request.',
            ], 403);
        }

        // Only allow updating if the help request is still pending
        if ($helpRequest->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot update a help request that has already been responded to.',
            ], 400);
        }

        // just update the status either resolved or cancelled
        $request->validate([
            'status' => 'required|in:resolved,cancelled',
        ]);

        $helpRequest->status = $request->status;
        $helpRequest->update();

        return response()->json([
            'success' => true,
            'data' => new HelpRequestsResource($helpRequest),
            'message' => 'Help request updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function responds(Request $request, string $id)
    {
        $request->validate([
            'action' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $user = auth()->user();
        $helpRequest = UserHelpRequest::findOrFail($id);

        if ($helpRequest->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'This help request has already been responded to.',
            ], 400);
        }

        // Check if user has already responded with 'completed' action
        $userCompletedResponse = $helpRequest->requestLogs()
            ->where('performed_by', $user->id)
            ->where('action', 'completed')
            ->exists();

        if ($userCompletedResponse) {
            return response()->json([
                'success' => false,
                'message' => 'You have already completed your response to this help request.',
            ], 400);
        }

        // Get count of unique users who have responded (excluding those with 'completed' action)
        $uniqueRespondersCount = $helpRequest->requestLogs()
            ->whereNotIn('performed_by', function ($query) use ($helpRequest) {
                $query->select('performed_by')
                    ->from('user_help_request_logs')
                    ->where('help_request_id', $helpRequest->id)
                    ->where('action', 'completed');
            })
            ->distinct('performed_by')
            ->count('performed_by');

        // Check if user has already responded (and hasn't completed)
        $userHasResponded = $helpRequest->requestLogs()
            ->where('performed_by', $user->id)
            ->exists();

        // If 2 users have already responded and current user is not one of them, reject
        if ($uniqueRespondersCount >= 2 && !$userHasResponded) {
            return response()->json([
                'success' => false,
                'message' => 'Maximum of 2 responders has been reached for this help request.',
            ], 400);
        }

        DB::transaction(function () use ($request, $id, $user, $helpRequest) {
            // Log the response action
            $helpRequest->requestLogs()->create([
                'performed_by' => $user->id,
                'action' => $request->action,
                'note' => $request->note,
                'created_at' => now(),
            ]);

            NotificationService::notifyRequester(
                $helpRequest,
                $request->action,
                $request->note
            );
        });

        return response()->json([
            'success' => true,
            'message' => 'You have successfully responded to the help request.',
        ]);
    }
}
