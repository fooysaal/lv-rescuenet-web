# Firebase Push Notifications Implementation Summary

## ✅ What Was Implemented

A complete Firebase Cloud Messaging (FCM) push notification system for your RescueNet Laravel backend and Flutter mobile app.

---

## 📦 Installed Packages

### Laravel Backend

-   **kreait/firebase-php** (v8.0.0) - Firebase PHP SDK for sending push notifications

---

## 🗄️ Database Changes

### New Tables Created

1. **device_tokens**

    - Stores FCM tokens for user devices
    - Tracks device type (iOS/Android/Web)
    - Manages active/inactive status
    - Records last usage timestamp

2. **notifications**
    - Stores notification records for users
    - Tracks read/unread status
    - Supports different notification types

Run migrations with:

```bash
php artisan migrate
```

---

## 📁 Files Created/Modified

### New Files Created

1. **app/Services/NotificationService.php**

    - Core service for sending FCM push notifications
    - Handles notification creation in database
    - Manages invalid/expired token cleanup
    - Supports bulk notifications

2. **app/Models/DeviceToken.php**

    - Model for device token management
    - Includes active token scope
    - Relationships with User model

3. **app/Http/Controllers/Api/DeviceTokenController.php**

    - REST API for device token CRUD operations
    - Token registration and deactivation
    - Handles duplicate token updates

4. **app/Http/Controllers/Api/NotificationController.php**

    - REST API for notification management
    - Mark as read functionality
    - Unread count endpoint
    - Bulk operations support

5. **config/services.php** (updated)

    - Added Firebase configuration

6. **.env.example** (updated)

    - Added Firebase environment variables

7. **.gitignore** (updated)

    - Added Firebase credentials exclusion

8. **routes/api.php** (updated)

    - Added device token routes
    - Added notification routes

9. **FIREBASE_SETUP.md**

    - Complete setup guide for Firebase & Flutter

10. **PUSH_NOTIFICATION_API.md**

    - API reference documentation

11. **flutter_notification_service.dart**
    - Sample Flutter service for integration

### Modified Files

1. **app/Http/Controllers/Api/HelpRequestsController.php**

    - Added NotificationService import
    - Integrated push notifications in responds() method

2. **app/Models/User.php**

    - Added deviceTokens() relationship
    - Added notifications() relationship

3. **app/Models/Notification.php**

    - Added fillable fields
    - Added relationships and scopes

4. **database/migrations/2026_01_14_110047_create_device_tokens_table.php**
    - Complete migration structure

---

## 🚀 API Endpoints Added

### Device Token Management

-   `POST /api/v1/device-tokens` - Register/update device token
-   `GET /api/v1/device-tokens` - List all user tokens
-   `GET /api/v1/device-tokens/{id}` - Get specific token
-   `PUT /api/v1/device-tokens/{id}` - Update token info
-   `DELETE /api/v1/device-tokens/{id}` - Delete token
-   `POST /api/v1/device-tokens/deactivate` - Deactivate token

### Notification Management

-   `GET /api/v1/notifications` - List notifications (with pagination)
-   `GET /api/v1/notifications/unread-count` - Get unread count
-   `GET /api/v1/notifications/{id}` - Get specific notification
-   `POST /api/v1/notifications/{id}/mark-read` - Mark as read
-   `POST /api/v1/notifications/mark-all-read` - Mark all as read
-   `DELETE /api/v1/notifications/{id}` - Delete notification
-   `DELETE /api/v1/notifications/delete-all` - Delete all

### Existing Endpoint Enhanced

-   `POST /api/v1/help-requests/{id}/respond` - Now sends push notifications

---

## 🔧 Configuration Required

### 1. Firebase Console Setup

1. Create/use existing Firebase project
2. Download service account JSON credentials
3. Place in: `storage/app/firebase-credentials.json`
4. Add Android/iOS app to Firebase project
5. Download `google-services.json` (Android) and `GoogleService-Info.plist` (iOS)

### 2. Environment Variables

Add to `.env`:

```env
FIREBASE_CREDENTIALS=storage/app/firebase-credentials.json
FIREBASE_DATABASE_URL=https://your-project-id.firebaseio.com
```

### 3. Security

**IMPORTANT:** Never commit `firebase-credentials.json` to git!

-   Already added to `.gitignore`
-   Use secure storage in production (e.g., AWS Secrets Manager)

---

## 📱 Flutter Integration

### Required Packages

```yaml
dependencies:
    firebase_core: ^3.10.0
    firebase_messaging: ^15.1.6
    flutter_local_notifications: ^18.0.1
```

### Key Implementation Steps

1. Initialize Firebase in `main.dart`
2. Request notification permissions
3. Get FCM token
4. Register token with backend using `POST /api/v1/device-tokens`
5. Setup foreground/background message handlers
6. Handle notification taps for navigation
7. Implement token refresh listener

**See `FIREBASE_SETUP.md` for detailed Flutter code examples**
**See `flutter_notification_service.dart` for complete service implementation**

---

## 🎯 How It Works

### Notification Flow

1. **User Registration**

    - Flutter app gets FCM token from Firebase
    - App registers token with Laravel backend
    - Token stored in `device_tokens` table

2. **Sending Notification**

    - Event occurs (e.g., help request response)
    - NotificationService creates notification record
    - FCM sends push notification to all active user devices
    - Invalid tokens automatically marked as inactive

3. **Receiving Notification**

    - Device receives push notification
    - Foreground: Show in-app notification
    - Background: System displays notification
    - User taps: App navigates to relevant screen

4. **Notification Management**
    - User views notifications in-app
    - Mark as read individually or all at once
    - Delete unwanted notifications
    - Badge shows unread count

---

## 🔍 Testing

### Test Push Notification with Tinker

```bash
php artisan tinker
```

```php
$user = App\Models\User::find(1);
$service = new App\Services\NotificationService();
$service->sendPushNotification(
    $user,
    'Test Notification',
    'This is a test message',
    ['type' => 'test']
);
```

### Test via API

```bash
curl -X POST https://your-api.com/api/v1/help-requests/1/respond \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "action": "dispatched",
    "note": "Help is on the way!"
  }'
```

---

## 📋 Notification Actions Supported

When responding to help requests, these actions trigger notifications:

-   `acknowledged` - "Your help request has been acknowledged by emergency services."
-   `dispatched` - "Help is on the way! Emergency services have been dispatched."
-   `arrived` - "Emergency services have arrived at your location."
-   `completed` - "Your help request has been completed."
-   `cancelled` - "Your help request has been cancelled."

Custom notes can be appended to any action.

---

## 🛠️ Extending the System

### Send Custom Notifications

```php
use App\Services\NotificationService;

$service = new NotificationService();
$user = User::find($userId);

$service->sendCustomNotification(
    $user,
    'custom_type',
    'Your custom message here',
    ['custom_key' => 'custom_value']
);
```

### Send to Multiple Users

```php
$service = new NotificationService();
$userIds = [1, 2, 3, 4, 5];

$service->sendBulkPushNotification(
    $userIds,
    'Bulk Notification',
    'This message goes to multiple users',
    ['type' => 'announcement']
);
```

---

## 📊 Database Schema

### device_tokens

```sql
- id (bigint, PK)
- user_id (bigint, FK -> users.id)
- token (string, unique)
- device_type (string, nullable)
- device_name (string, nullable)
- is_active (boolean, default: true)
- last_used_at (timestamp, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### notifications

```sql
- id (bigint, PK)
- user_id (bigint, FK -> users.id)
- type (string)
- message (text)
- is_read (boolean, default: false)
- created_at (timestamp)
- updated_at (timestamp)
```

---

## 🔒 Security Considerations

1. **Authentication**: All endpoints require `auth:sanctum` middleware
2. **Authorization**: Users can only access their own tokens/notifications
3. **Token Storage**: FCM tokens are unique per user-device combination
4. **Credentials**: Firebase credentials excluded from version control
5. **Rate Limiting**: Consider adding rate limits to prevent abuse
6. **Validation**: All inputs are validated before processing

---

## 📚 Documentation Files

1. **FIREBASE_SETUP.md** - Complete Firebase and Flutter setup guide
2. **PUSH_NOTIFICATION_API.md** - Full API reference with examples
3. **flutter_notification_service.dart** - Sample Flutter implementation

---

## ✨ Features

-   ✅ FCM push notification integration
-   ✅ Multi-device support per user
-   ✅ Automatic invalid token cleanup
-   ✅ Notification history in database
-   ✅ Read/unread status tracking
-   ✅ Unread notification count
-   ✅ Bulk notification operations
-   ✅ Custom notification types
-   ✅ Rich notification data payload
-   ✅ Background and foreground handling
-   ✅ Deep linking support ready
-   ✅ Token refresh handling
-   ✅ Comprehensive API documentation

---

## 🚀 Next Steps

1. **Firebase Setup**

    - Create Firebase project
    - Download credentials
    - Configure Android/iOS apps

2. **Deploy Backend**

    - Run migrations
    - Add environment variables
    - Test with tinker

3. **Flutter Integration**

    - Add Firebase packages
    - Implement notification service
    - Test end-to-end flow

4. **Production**
    - Secure credential storage
    - Enable monitoring/logging
    - Test on real devices

---

## 📞 Support

For detailed implementation steps, refer to:

-   `FIREBASE_SETUP.md` - Setup instructions
-   `PUSH_NOTIFICATION_API.md` - API documentation
-   `flutter_notification_service.dart` - Flutter code sample

---

## 🎉 Implementation Complete!

Your RescueNet application now has a complete push notification system ready for production use. All necessary backend infrastructure is in place, and comprehensive documentation is provided for Flutter integration.
