# 📋 Firebase FCM Setup Checklist

Use this checklist to ensure everything is properly configured.

---

## ✅ Backend Setup

### Laravel Configuration

-   [ ] Package installed: `kreait/firebase-php` (v8.0.0)
-   [ ] Migrations run: `php artisan migrate`
-   [ ] Tables created: `device_tokens`, `notifications`
-   [ ] Firebase credentials file obtained from Firebase Console
-   [ ] Credentials placed in: `storage/app/firebase-credentials.json`
-   [ ] Environment variables added to `.env`:
    ```env
    FIREBASE_CREDENTIALS=storage/app/firebase-credentials.json
    FIREBASE_DATABASE_URL=https://your-project-id.firebaseio.com
    ```
-   [ ] Firebase credentials excluded from git (check `.gitignore`)
-   [ ] Tested notification service in tinker:
    ```php
    $user = App\Models\User::first();
    $service = new App\Services\NotificationService();
    // Should not throw error
    ```

### Verify Routes

-   [ ] Device token routes accessible
-   [ ] Notification routes accessible
-   [ ] Help request response endpoint works

Run to verify:

```bash
php artisan route:list --path=api/v1 | grep -E "(device-tokens|notifications)"
```

---

## ✅ Firebase Console Setup

### Project Setup

-   [ ] Firebase project created/selected
-   [ ] Service account JSON downloaded
-   [ ] Android app added to Firebase project
-   [ ] iOS app added to Firebase project (if applicable)

### Android Configuration

-   [ ] Package name matches app (e.g., `com.rescuenet.app`)
-   [ ] `google-services.json` downloaded
-   [ ] SHA-1 certificate fingerprint added (optional, for debug)

### iOS Configuration

-   [ ] Bundle ID matches app
-   [ ] `GoogleService-Info.plist` downloaded
-   [ ] APNs Authentication Key uploaded to Firebase Console
-   [ ] APNs certificate configured

---

## ✅ Flutter App Setup

### Dependencies

-   [ ] `firebase_core: ^3.10.0` added to `pubspec.yaml`
-   [ ] `firebase_messaging: ^15.1.6` added to `pubspec.yaml`
-   [ ] `flutter_local_notifications: ^18.0.1` added to `pubspec.yaml`
-   [ ] `http: ^1.2.0` added to `pubspec.yaml`
-   [ ] `flutter pub get` executed

### Configuration Files

-   [ ] `google-services.json` in `android/app/`
-   [ ] `GoogleService-Info.plist` in `ios/Runner/`

### Android Setup

-   [ ] `google-services` plugin added to `android/build.gradle`
-   [ ] Plugin applied in `android/app/build.gradle`
-   [ ] Internet permission in `AndroidManifest.xml`:
    ```xml
    <uses-permission android:name="android.permission.INTERNET" />
    ```

### iOS Setup (if applicable)

-   [ ] Firebase SDK initialized in Xcode
-   [ ] Push notification capability enabled
-   [ ] Background modes enabled (Remote notifications)
-   [ ] `GoogleService-Info.plist` added to project

### Code Implementation

-   [ ] Firebase initialized in `main.dart`:
    ```dart
    await Firebase.initializeApp();
    ```
-   [ ] Background message handler defined:
    ```dart
    FirebaseMessaging.onBackgroundMessage(_firebaseMessagingBackgroundHandler);
    ```
-   [ ] Notification permissions requested
-   [ ] FCM token retrieved and logged
-   [ ] Token registration with backend implemented
-   [ ] Foreground message handler implemented
-   [ ] Background message handler implemented
-   [ ] Notification tap handler implemented
-   [ ] Token refresh listener implemented

---

## ✅ Testing

### Backend Tests

-   [ ] Test notification send via tinker
-   [ ] Verify notification in database
-   [ ] Test device token registration endpoint
-   [ ] Test device token deactivation endpoint
-   [ ] Test notification list endpoint
-   [ ] Test help request response triggers notification

### Flutter Tests

-   [ ] App runs without errors
-   [ ] FCM token printed in console
-   [ ] Token registration API call succeeds
-   [ ] Foreground notification appears
-   [ ] Background notification appears
-   [ ] Notification tap opens correct screen
-   [ ] Token refresh updates backend

### Integration Tests

-   [ ] End-to-end notification flow works
-   [ ] Multiple devices receive notifications
-   [ ] Invalid tokens marked inactive
-   [ ] Read/unread status updates correctly

---

## ✅ Production Readiness

### Security

-   [ ] Firebase credentials NOT in version control
-   [ ] Environment variables secured (use secrets manager in production)
-   [ ] API rate limiting configured
-   [ ] Authentication required for all endpoints
-   [ ] User authorization checks in place

### Monitoring

-   [ ] Firebase Console monitoring enabled
-   [ ] Laravel application logging configured
-   [ ] Error tracking service integrated (Sentry, Bugsnag, etc.)
-   [ ] Notification delivery success rate monitored

### Performance

-   [ ] Database indexes on `device_tokens.user_id`
-   [ ] Database indexes on `notifications.user_id`
-   [ ] Pagination implemented for notifications list
-   [ ] Batch notification sending for multiple users

### Documentation

-   [ ] Team trained on how to send notifications
-   [ ] API documentation shared with frontend team
-   [ ] Firebase project access shared with team
-   [ ] Credentials backup stored securely

---

## ✅ Optional Enhancements

### Advanced Features

-   [ ] Notification scheduling
-   [ ] Rich notifications with images
-   [ ] Notification categories/channels
-   [ ] Silent notifications for data sync
-   [ ] Priority/urgent notifications
-   [ ] Notification grouping
-   [ ] Action buttons on notifications

### Analytics

-   [ ] Track notification open rates
-   [ ] Track notification delivery rates
-   [ ] Monitor user engagement
-   [ ] A/B test notification messages

### User Preferences

-   [ ] Notification preferences endpoint
-   [ ] Allow users to disable certain notification types
-   [ ] Quiet hours support
-   [ ] Per-device notification settings

---

## 🐛 Common Issues & Solutions

### "Firebase credentials file not found"

**Solution:**

-   Verify path in `.env` matches actual file location
-   Check file permissions: `chmod 644 storage/app/firebase-credentials.json`

### "No notifications received on device"

**Solution:**

-   Verify FCM token exists in `device_tokens` table
-   Check `is_active` is true
-   View Laravel logs: `tail -f storage/logs/laravel.log`
-   Test with Firebase Console test message

### "Invalid FCM token" errors

**Solution:**

-   These are normal when tokens expire
-   System automatically marks them inactive
-   User needs to restart app to refresh token

### iOS notifications not working

**Solution:**

-   Verify APNs certificate in Firebase Console
-   Check notification permissions granted
-   Ensure app has proper entitlements
-   Test with production APNs environment

### Android notifications not working

**Solution:**

-   Verify `google-services.json` is correct
-   Check Firebase project ID matches
-   Ensure internet permission granted
-   Test with Firebase Console

---

## 📞 Need Help?

### Documentation

-   [QUICK_START.md](QUICK_START.md) - Quick setup guide
-   [FIREBASE_SETUP.md](FIREBASE_SETUP.md) - Detailed setup
-   [PUSH_NOTIFICATION_API.md](PUSH_NOTIFICATION_API.md) - API reference
-   [IMPLEMENTATION_SUMMARY.md](IMPLEMENTATION_SUMMARY.md) - Implementation details

### External Resources

-   [Firebase Cloud Messaging](https://firebase.google.com/docs/cloud-messaging)
-   [FlutterFire Documentation](https://firebase.flutter.dev/)
-   [kreait/firebase-php](https://github.com/kreait/firebase-php)

### Logs

-   Laravel: `storage/logs/laravel.log`
-   Firebase Console: https://console.firebase.google.com/
-   Flutter: Check device logs/console

---

## 🎉 All Done?

Once all items are checked:

1. Test in development environment
2. Test in staging environment
3. Deploy to production
4. Monitor for 24 hours
5. Celebrate! 🎊

---

Last Updated: January 14, 2026
