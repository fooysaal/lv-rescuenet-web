# Firebase Cloud Messaging (FCM) Setup Guide

This guide will walk you through setting up Firebase Cloud Messaging for push notifications in your RescueNet application.

## 1. Firebase Console Setup

### Create Firebase Project

1. Go to [Firebase Console](https://console.firebase.google.com/)
2. Click "Add project" or select an existing project
3. Follow the setup wizard to create your project

### Get Service Account Credentials

1. In Firebase Console, go to **Project Settings** (gear icon) → **Service Accounts**
2. Click **Generate New Private Key**
3. Download the JSON file (e.g., `firebase-credentials.json`)
4. Place this file in your Laravel project at: `storage/app/firebase-credentials.json`

### Add Flutter App to Firebase

1. In Firebase Console, click the Android/iOS icon to add your app
2. Enter your package name (e.g., `com.rescuenet.app`)
3. Download the configuration files:
    - **Android**: `google-services.json` → Place in `android/app/`
    - **iOS**: `GoogleService-Info.plist` → Place in `ios/Runner/`

## 2. Laravel Backend Configuration

### Environment Variables

Add the following to your `.env` file:

```env
FIREBASE_CREDENTIALS=storage/app/firebase-credentials.json
FIREBASE_DATABASE_URL=https://your-project-id.firebaseio.com
```

### Verify Installation

Run the migration to create the device tokens table:

```bash
php artisan migrate
```

## 3. Flutter App Setup

### Install Dependencies

Add these packages to your `pubspec.yaml`:

```yaml
dependencies:
    firebase_core: ^3.10.0
    firebase_messaging: ^15.1.6
    flutter_local_notifications: ^18.0.1
```

Run:

```bash
flutter pub get
```

### Initialize Firebase in Flutter

**lib/main.dart:**

```dart
import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';

// Background message handler
Future<void> _firebaseMessagingBackgroundHandler(RemoteMessage message) async {
  await Firebase.initializeApp();
  print('Background message: ${message.notification?.title}');
}

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  // Initialize Firebase
  await Firebase.initializeApp();

  // Set background message handler
  FirebaseMessaging.onBackgroundMessage(_firebaseMessagingBackgroundHandler);

  runApp(MyApp());
}
```

### Request Notification Permissions

```dart
Future<void> requestNotificationPermission() async {
  FirebaseMessaging messaging = FirebaseMessaging.instance;

  NotificationSettings settings = await messaging.requestPermission(
    alert: true,
    badge: true,
    sound: true,
    provisional: false,
  );

  if (settings.authorizationStatus == AuthorizationStatus.authorized) {
    print('User granted permission');
  }
}
```

### Get FCM Token

```dart
Future<String?> getFCMToken() async {
  String? token = await FirebaseMessaging.instance.getToken();
  print('FCM Token: $token');
  return token;
}
```

### Register Token with Laravel Backend

```dart
import 'package:http/http.dart' as http;
import 'dart:convert';

Future<void> registerDeviceToken(String token) async {
  final response = await http.post(
    Uri.parse('https://your-api.com/api/v1/device-tokens'),
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer YOUR_ACCESS_TOKEN',
    },
    body: jsonEncode({
      'token': token,
      'device_type': Platform.isIOS ? 'ios' : 'android',
      'device_name': 'User Device Name', // Optional
    }),
  );

  if (response.statusCode == 201) {
    print('Device token registered successfully');
  }
}
```

### Handle Foreground Notifications

```dart
void setupForegroundNotificationHandler() {
  FirebaseMessaging.onMessage.listen((RemoteMessage message) {
    print('Foreground message received');

    if (message.notification != null) {
      // Show local notification
      showLocalNotification(
        message.notification!.title ?? '',
        message.notification!.body ?? '',
        message.data,
      );
    }
  });
}
```

### Handle Notification Taps

```dart
void setupNotificationTapHandler() {
  // Handle when app is opened from terminated state
  FirebaseMessaging.instance.getInitialMessage().then((message) {
    if (message != null) {
      handleNotificationTap(message);
    }
  });

  // Handle when app is in background
  FirebaseMessaging.onMessageOpenedApp.listen((message) {
    handleNotificationTap(message);
  });
}

void handleNotificationTap(RemoteMessage message) {
  final data = message.data;

  if (data['type'] == 'help_request_response') {
    // Navigate to help request details
    String helpRequestId = data['help_request_id'];
    // Navigator.push(...);
  }
}
```

## 4. API Endpoints

### Register/Update Device Token

```
POST /api/v1/device-tokens
Authorization: Bearer {token}
Content-Type: application/json

{
  "token": "FCM_TOKEN_HERE",
  "device_type": "android|ios|web",
  "device_name": "Pixel 6 Pro"
}
```

### Get All Device Tokens

```
GET /api/v1/device-tokens
Authorization: Bearer {token}
```

### Deactivate Token

```
POST /api/v1/device-tokens/deactivate
Authorization: Bearer {token}
Content-Type: application/json

{
  "token": "FCM_TOKEN_TO_DEACTIVATE"
}
```

### Delete Device Token

```
DELETE /api/v1/device-tokens/{id}
Authorization: Bearer {token}
```

## 5. Testing Push Notifications

### From Laravel Tinker

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
    ['type' => 'test', 'data' => 'custom_data']
);
```

### Using Postman or cURL

Test the help request response endpoint:

```bash
curl -X POST https://your-api.com/api/v1/help-requests/1/respond \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "action": "dispatched",
    "note": "Help is on the way!"
  }'
```

## 6. Notification Payload Structure

When a notification is sent, it includes:

```json
{
    "notification": {
        "title": "Help Request Update",
        "body": "Help is on the way! Emergency services have been dispatched."
    },
    "data": {
        "type": "help_request_response",
        "help_request_id": "123",
        "action": "dispatched",
        "notification_id": "456"
    }
}
```

## 7. Troubleshooting

### Common Issues

1. **"Firebase credentials file not found"**

    - Ensure `firebase-credentials.json` is in `storage/app/`
    - Check the path in `.env` matches the file location

2. **"Invalid FCM token"**

    - Token may have expired or been unregistered
    - App should refresh and re-register the token

3. **Notifications not received on iOS**

    - Ensure APNs certificate is configured in Firebase Console
    - Check app has notification permissions

4. **Background notifications not working**
    - Verify `_firebaseMessagingBackgroundHandler` is set up
    - Check app has background execution permissions

### Debug Logging

Enable debug logging in Laravel:

```php
// config/logging.php
'channels' => [
    'stack' => [
        'channels' => ['single', 'slack'],
    ],
],
```

Check logs:

```bash
tail -f storage/logs/laravel.log
```

## 8. Production Checklist

-   [ ] Firebase credentials file securely stored
-   [ ] `.env` variables configured correctly
-   [ ] Database migrations run
-   [ ] FCM token refresh logic implemented in Flutter app
-   [ ] Error handling for invalid/expired tokens
-   [ ] Notification icons and sounds configured
-   [ ] Deep linking for notification taps implemented
-   [ ] Background notification handler tested
-   [ ] APNs certificate configured for iOS
-   [ ] Test notifications on both Android and iOS devices

## 9. Security Best Practices

1. **Never commit** `firebase-credentials.json` to version control
2. Add to `.gitignore`:
    ```
    storage/app/firebase-credentials.json
    ```
3. Store credentials securely in production (e.g., environment variables, secret managers)
4. Implement rate limiting on device token registration endpoints
5. Validate and sanitize all notification content

## 10. Additional Resources

-   [Firebase Cloud Messaging Documentation](https://firebase.google.com/docs/cloud-messaging)
-   [FlutterFire Documentation](https://firebase.flutter.dev/docs/overview)
-   [kreait/firebase-php Package](https://github.com/kreait/firebase-php)
