<?php

namespace App\Services;

use App\Models\User;
use App\Models\Notification;
use App\Models\UserHelpRequest;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FcmNotification;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    protected $messaging;

    public function __construct()
    {
        try {
            $credentialsPath = config('services.firebase.credentials');

            if (!file_exists($credentialsPath)) {
                Log::warning('Firebase credentials file not found at: ' . $credentialsPath);
                return;
            }

            $factory = (new Factory)->withServiceAccount($credentialsPath);
            $this->messaging = $factory->createMessaging();
        } catch (\Exception $e) {
            Log::error('Failed to initialize Firebase: ' . $e->getMessage());
        }
    }

    /**
     * Notify the requester about help request response.
     */
    public static function notifyRequester(UserHelpRequest $helpRequest, string $action, ?string $note = null)
    {
        $instance = new self();

        // Create notification record in database
        $notification = Notification::create([
            'user_id' => $helpRequest->user_id,
            'type' => 'help_request_response',
            'message' => self::generateMessage($action, $note),
            'is_read' => false,
        ]);

        // Send push notification
        $instance->sendPushNotification(
            $helpRequest->user,
            'Help Request Update',
            self::generateMessage($action, $note),
            [
                'type' => 'help_request_response',
                'help_request_id' => (string) $helpRequest->id,
                'action' => $action,
                'notification_id' => (string) $notification->id,
            ]
        );

        return $notification;
    }

    /**
     * Send push notification to a user.
     */
    public function sendPushNotification(User $user, string $title, string $body, array $data = [])
    {
        if (!$this->messaging) {
            Log::warning('Firebase messaging not initialized. Skipping push notification.');
            return false;
        }

        // Get all active device tokens for the user
        $deviceTokens = $user->deviceTokens()->active()->pluck('token')->toArray();

        if (empty($deviceTokens)) {
            Log::info("No active device tokens found for user {$user->id}");
            return false;
        }

        try {
            $notification = FcmNotification::create($title, $body);

            foreach ($deviceTokens as $token) {
                try {
                    $message = CloudMessage::withTarget('token', $token)
                        ->withNotification($notification)
                        ->withData($data);

                    $this->messaging->send($message);

                    // Update last_used_at for the token
                    $user->deviceTokens()
                        ->where('token', $token)
                        ->update(['last_used_at' => now()]);
                } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
                    // Token is invalid, deactivate it
                    Log::warning("Invalid FCM token for user {$user->id}: {$token}");
                    $user->deviceTokens()
                        ->where('token', $token)
                        ->update(['is_active' => false]);
                } catch (\Exception $e) {
                    Log::error("Failed to send FCM notification to token {$token}: " . $e->getMessage());
                }
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send push notification: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send notification to multiple users.
     */
    public function sendBulkPushNotification(array $userIds, string $title, string $body, array $data = [])
    {
        foreach ($userIds as $userId) {
            $user = User::find($userId);
            if ($user) {
                $this->sendPushNotification($user, $title, $body, $data);
            }
        }
    }

    /**
     * Generate notification message based on action.
     */
    private static function generateMessage(string $action, ?string $note = null): string
    {
        $messages = [
            'acknowledged' => 'Your help request has been acknowledged by emergency services.',
            'dispatched' => 'Help is on the way! Emergency services have been dispatched.',
            'arrived' => 'Emergency services have arrived at your location.',
            'completed' => 'Your help request has been completed.',
            'cancelled' => 'Your help request has been cancelled.',
        ];

        $message = $messages[$action] ?? "Your help request status has been updated to: {$action}";

        if ($note) {
            $message .= " Note: {$note}";
        }

        return $message;
    }

    /**
     * Send custom notification to a user.
     */
    public function sendCustomNotification(User $user, string $type, string $message, array $data = [])
    {
        // Create notification record
        $notification = Notification::create([
            'user_id' => $user->id,
            'type' => $type,
            'message' => $message,
            'is_read' => false,
        ]);

        // Send push notification
        $this->sendPushNotification(
            $user,
            'New Notification',
            $message,
            array_merge($data, [
                'notification_id' => (string) $notification->id,
                'type' => $type,
            ])
        );

        return $notification;
    }
}
