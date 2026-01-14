# 🚀 Quick Start Guide - Push Notifications

## Prerequisites

-   Firebase account
-   Flutter app with Firebase configured
-   Laravel backend deployed

---

## Step 1: Firebase Console (5 minutes)

### 1.1 Create/Select Project

1. Go to https://console.firebase.google.com/
2. Create new project or select existing one

### 1.2 Get Service Account Key

1. Go to **Project Settings** (⚙️) → **Service Accounts**
2. Click **Generate New Private Key**
3. Download the JSON file
4. Rename to `firebase-credentials.json`
5. Place in `storage/app/firebase-credentials.json`

### 1.3 Add Mobile Apps

**For Android:**

1. Click Android icon
2. Enter package name (e.g., `com.rescuenet.app`)
3. Download `google-services.json`
4. Place in `android/app/google-services.json`

**For iOS:**

1. Click iOS icon
2. Enter bundle ID
3. Download `GoogleService-Info.plist`
4. Place in `ios/Runner/GoogleService-Info.plist`

---

## Step 2: Backend Configuration (2 minutes)

### 2.1 Set Environment Variables

Edit `.env`:

```env
FIREBASE_CREDENTIALS=storage/app/firebase-credentials.json
FIREBASE_DATABASE_URL=https://your-project-id.firebaseio.com
```

### 2.2 Run Migration

```bash
php artisan migrate
```

### 2.3 Test Configuration

```bash
php artisan tinker
```

```php
$user = App\Models\User::first();
$service = new App\Services\NotificationService();
echo "Firebase initialized: " . ($service ? "✅" : "❌");
```

---

## Step 3: Flutter App Setup (10 minutes)

### 3.1 Add Dependencies

Add to `pubspec.yaml`:

```yaml
dependencies:
    firebase_core: ^3.10.0
    firebase_messaging: ^15.1.6
    flutter_local_notifications: ^18.0.1
    http: ^1.2.0
```

Run:

```bash
flutter pub get
```

### 3.2 Initialize Firebase

In `lib/main.dart`:

```dart
import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';

// Top-level background handler
@pragma('vm:entry-point')
Future<void> _firebaseMessagingBackgroundHandler(RemoteMessage message) async {
  await Firebase.initializeApp();
  print('Background message: ${message.notification?.title}');
}

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  // Initialize Firebase
  await Firebase.initializeApp();

  // Set background handler
  FirebaseMessaging.onBackgroundMessage(_firebaseMessagingBackgroundHandler);

  runApp(MyApp());
}
```

### 3.3 Request Permissions

```dart
Future<void> requestPermissions() async {
  FirebaseMessaging messaging = FirebaseMessaging.instance;

  NotificationSettings settings = await messaging.requestPermission(
    alert: true,
    badge: true,
    sound: true,
  );

  print('Permission: ${settings.authorizationStatus}');
}
```

### 3.4 Get and Register FCM Token

```dart
Future<void> setupNotifications() async {
  // Get token
  String? token = await FirebaseMessaging.instance.getToken();
  print('FCM Token: $token');

  if (token != null) {
    // Register with backend
    await registerToken(token);
  }

  // Listen for token refresh
  FirebaseMessaging.instance.onTokenRefresh.listen((newToken) {
    registerToken(newToken);
  });
}

Future<void> registerToken(String token) async {
  final response = await http.post(
    Uri.parse('YOUR_API_URL/api/v1/device-tokens'),
    headers: {
      'Authorization': 'Bearer YOUR_ACCESS_TOKEN',
      'Content-Type': 'application/json',
    },
    body: jsonEncode({
      'token': token,
      'device_type': Platform.isIOS ? 'ios' : 'android',
    }),
  );

  print('Token registered: ${response.statusCode}');
}
```

### 3.5 Handle Foreground Messages

```dart
void setupForegroundHandler() {
  FirebaseMessaging.onMessage.listen((RemoteMessage message) {
    print('Foreground notification');

    if (message.notification != null) {
      // Show local notification
      showNotification(
        message.notification!.title ?? '',
        message.notification!.body ?? '',
      );
    }
  });
}
```

### 3.6 Handle Notification Taps

```dart
void setupNotificationTapHandler() {
  // From terminated state
  FirebaseMessaging.instance.getInitialMessage().then((message) {
    if (message != null) {
      handleNotificationTap(message);
    }
  });

  // From background state
  FirebaseMessaging.onMessageOpenedApp.listen(handleNotificationTap);
}

void handleNotificationTap(RemoteMessage message) {
  final type = message.data['type'];

  if (type == 'help_request_response') {
    final helpRequestId = message.data['help_request_id'];
    // Navigate to help request details
    Navigator.pushNamed(context, '/help-request/$helpRequestId');
  }
}
```

---

## Step 4: Test Everything (5 minutes)

### 4.1 Test Token Registration

1. Run Flutter app
2. Check console for FCM token
3. Verify token in database:

```sql
SELECT * FROM device_tokens WHERE user_id = YOUR_USER_ID;
```

### 4.2 Send Test Notification

**From Laravel Tinker:**

```bash
php artisan tinker
```

```php
$user = App\Models\User::find(YOUR_USER_ID);
$service = new App\Services\NotificationService();

$service->sendPushNotification(
    $user,
    'Test Notification',
    'Your push notification is working! 🎉',
    ['type' => 'test']
);
```

**Expected Result:**

-   ✅ Notification appears on device
-   ✅ Tapping navigates correctly
-   ✅ Notification saved in database

### 4.3 Test Help Request Flow

**Send API Request:**

```bash
curl -X POST http://your-api.com/api/v1/help-requests/1/respond \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "action": "dispatched",
    "note": "Help is on the way!"
  }'
```

**Expected Result:**

-   ✅ Push notification sent
-   ✅ Notification record created
-   ✅ Device receives notification

---

## Step 5: Production Checklist

### Security

-   [ ] Firebase credentials NOT in git (check `.gitignore`)
-   [ ] Environment variables set correctly
-   [ ] Use secure credential storage (AWS Secrets, etc.)

### iOS Specific

-   [ ] APNs certificate uploaded to Firebase
-   [ ] Notification capability enabled in Xcode
-   [ ] Background modes configured

### Android Specific

-   [ ] `google-services.json` in correct location
-   [ ] Firebase dependencies in `build.gradle`
-   [ ] Internet permission in `AndroidManifest.xml`

### Testing

-   [ ] Foreground notifications work
-   [ ] Background notifications work
-   [ ] Notification taps navigate correctly
-   [ ] Token refresh updates backend
-   [ ] Logout deactivates token
-   [ ] Invalid tokens marked inactive

### Monitoring

-   [ ] Firebase Console monitoring enabled
-   [ ] Laravel logs configured
-   [ ] Error tracking set up
-   [ ] Success rate monitoring

---

## Troubleshooting

### "Firebase credentials not found"

-   Check file path in `.env`
-   Verify file exists in `storage/app/`
-   Check file permissions

### "No notifications received"

-   Verify FCM token registered in database
-   Check token is active (`is_active = 1`)
-   Check Laravel logs for errors
-   Verify Firebase project ID matches

### iOS notifications not working

-   Ensure APNs certificate in Firebase Console
-   Check notification permissions granted
-   Verify bundle ID matches Firebase

### Android notifications not working

-   Check `google-services.json` in place
-   Verify package name matches Firebase
-   Check internet permission

---

## Common API Usage

### Get Unread Count (for badge)

```dart
final response = await http.get(
  Uri.parse('$baseUrl/api/v1/notifications/unread-count'),
  headers: {'Authorization': 'Bearer $token'},
);

final count = jsonDecode(response.body)['data']['unread_count'];
```

### Mark Notification as Read

```dart
await http.post(
  Uri.parse('$baseUrl/api/v1/notifications/$id/mark-read'),
  headers: {'Authorization': 'Bearer $token'},
);
```

### Deactivate on Logout

```dart
await http.post(
  Uri.parse('$baseUrl/api/v1/device-tokens/deactivate'),
  headers: {
    'Authorization': 'Bearer $token',
    'Content-Type': 'application/json',
  },
  body: jsonEncode({'token': fcmToken}),
);
```

---

## 🎉 You're Done!

Your push notification system is now ready for production. For more details, see:

-   `FIREBASE_SETUP.md` - Detailed setup guide
-   `PUSH_NOTIFICATION_API.md` - Complete API reference
-   `IMPLEMENTATION_SUMMARY.md` - What was implemented
-   `flutter_notification_service.dart` - Full Flutter service

---

## Need Help?

-   Firebase Console: https://console.firebase.google.com/
-   Firebase Docs: https://firebase.google.com/docs/cloud-messaging
-   FlutterFire: https://firebase.flutter.dev/
-   Laravel Logs: `storage/logs/laravel.log`
