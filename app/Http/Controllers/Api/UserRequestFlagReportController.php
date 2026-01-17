<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserRequestFlagReport;
use App\Models\UserHelpRequest;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserRequestFlagReportController extends Controller
{
    /**
     * Submit a flag report for a help request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'request_id' => 'required|exists:user_help_requests,id',
            'report_type' => 'required|in:Invalid Location,Unclear Request,Other',
            'report_reason' => 'required|string|max:1000',
            'report_attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $userId = auth()->id();
        $helpRequestId = $request->request_id;

        // Check if user already submitted a flag report for this request
        $existingReport = UserRequestFlagReport::where('user_help_request_id', $helpRequestId)
            ->where('reported_by_user_id', $userId)
            ->first();

        if ($existingReport) {
            return response()->json([
                'success' => false,
                'message' => 'You have already submitted a flag report for this help request'
            ], 409);
        }

        // Get the help request
        $helpRequest = UserHelpRequest::findOrFail($helpRequestId);

        // Check if help request is already cancelled
        if ($helpRequest->status === 'cancelled') {
            return response()->json([
                'success' => false,
                'message' => 'This help request has already been cancelled'
            ], 400);
        }

        DB::beginTransaction();

        try {
            // Create the flag report
            $flagReport = UserRequestFlagReport::create([
                'user_help_request_id' => $helpRequestId,
                'reported_by_user_id' => $userId,
                'report_type' => $request->report_type,
                'report_reason' => $request->report_reason,
            ]);

            // Handle attachment if provided
            if ($request->hasFile('report_attachment')) {
                $file = $request->file('report_attachment');
                $extension = $file->getClientOriginalExtension();
                $filename = "report-{$flagReport->id}.{$extension}";
                $path = $file->storeAs('flag-reports', $filename, 'public');

                $flagReport->update(['attachment' => $path]);
            }

            // Check if the same report type has been submitted by 3 different users
            $sameTypeReportsCount = UserRequestFlagReport::where('user_help_request_id', $helpRequestId)
                ->where('report_type', $request->report_type)
                ->distinct('reported_by_user_id')
                ->count('reported_by_user_id');

            if ($sameTypeReportsCount >= 3) {
                // Cancel the help request
                $helpRequest->update(['status' => 'cancelled']);

                // Notify the requester about cancellation
                $this->notifyRequestCancellation($helpRequest, $request->report_type);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Flag report submitted successfully',
                'data' => [
                    'flag_report_id' => $flagReport->id,
                    'help_request_status' => $helpRequest->fresh()->status,
                ]
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit flag report',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Notify the requester about help request cancellation
     */
    private function notifyRequestCancellation(UserHelpRequest $helpRequest, string $reportType)
    {
        // Create notification record in database
        $notification = Notification::create([
            'user_id' => $helpRequest->user_id,
            'type' => 'help_request_cancelled',
            'message' => "Your help request has been cancelled due to multiple reports (Reason: {$reportType}). If you believe this is a mistake, please contact support.",
            'is_read' => false,
        ]);

        // Send push notification
        $notificationService = new NotificationService();
        $notificationService->sendPushNotification(
            $helpRequest->user,
            'Help Request Cancelled',
            "Your help request has been cancelled due to multiple reports.",
            [
                'type' => 'help_request_cancelled',
                'help_request_id' => (string) $helpRequest->id,
                'report_type' => $reportType,
                'notification_id' => (string) $notification->id,
            ]
        );
    }
}
