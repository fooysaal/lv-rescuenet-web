# Push Notifications API Reference

## Overview

This API provides endpoints for managing device tokens and notifications using Firebase Cloud Messaging (FCM).

Base URL: `https://your-api.com/api/v1`

All endpoints require authentication using Bearer token unless specified otherwise.

---

## Device Token Management

### 1. Register/Update Device Token

Register a new device token or update an existing one for push notifications.

**Endpoint:** `POST /device-tokens`

**Headers:**

```
Authorization: Bearer {access_token}
Content-Type: application/json
```

**Request Body:**

```json
{
    "token": "fcm_device_token_here",
    "device_type": "android", // Optional: "android", "ios", "web"
    "device_name": "Pixel 6 Pro" // Optional
}
```

**Success Response (201):**

```json
{
    "success": true,
    "message": "Device token registered successfully",
    "data": {
        "id": 1,
        "user_id": 1,
        "token": "fcm_device_token_here",
        "device_type": "android",
        "device_name": "Pixel 6 Pro",
        "is_active": true,
        "last_used_at": "2026-01-14T10:30:00Z",
        "created_at": "2026-01-14T10:30:00Z",
        "updated_at": "2026-01-14T10:30:00Z"
    }
}
```

---

### 2. Get All Device Tokens

Retrieve all device tokens for the authenticated user.

**Endpoint:** `GET /device-tokens`

**Success Response (200):**

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "token": "fcm_token_1",
            "device_type": "android",
            "device_name": "Pixel 6 Pro",
            "is_active": true,
            "last_used_at": "2026-01-14T10:30:00Z",
            "created_at": "2026-01-14T10:00:00Z",
            "updated_at": "2026-01-14T10:30:00Z"
        },
        {
            "id": 2,
            "user_id": 1,
            "token": "fcm_token_2",
            "device_type": "ios",
            "device_name": "iPhone 13",
            "is_active": true,
            "last_used_at": "2026-01-14T09:00:00Z",
            "created_at": "2026-01-13T10:00:00Z",
            "updated_at": "2026-01-14T09:00:00Z"
        }
    ]
}
```

---

### 3. Get Specific Device Token

Retrieve details of a specific device token.

**Endpoint:** `GET /device-tokens/{id}`

**Success Response (200):**

```json
{
    "success": true,
    "data": {
        "id": 1,
        "user_id": 1,
        "token": "fcm_device_token_here",
        "device_type": "android",
        "device_name": "Pixel 6 Pro",
        "is_active": true,
        "last_used_at": "2026-01-14T10:30:00Z",
        "created_at": "2026-01-14T10:00:00Z",
        "updated_at": "2026-01-14T10:30:00Z"
    }
}
```

---

### 4. Update Device Token

Update device information for a specific token.

**Endpoint:** `PUT /device-tokens/{id}`

**Request Body:**

```json
{
    "device_type": "android", // Optional
    "device_name": "New Device Name", // Optional
    "is_active": true // Optional
}
```

**Success Response (200):**

```json
{
    "success": true,
    "message": "Device token updated successfully",
    "data": {
        "id": 1,
        "user_id": 1,
        "token": "fcm_device_token_here",
        "device_type": "android",
        "device_name": "New Device Name",
        "is_active": true,
        "last_used_at": "2026-01-14T10:30:00Z",
        "created_at": "2026-01-14T10:00:00Z",
        "updated_at": "2026-01-14T11:00:00Z"
    }
}
```

---

### 5. Deactivate Device Token

Deactivate a device token (for logout or switching devices).

**Endpoint:** `POST /device-tokens/deactivate`

**Request Body:**

```json
{
    "token": "fcm_device_token_to_deactivate"
}
```

**Success Response (200):**

```json
{
    "success": true,
    "message": "Device token deactivated successfully"
}
```

**Error Response (404):**

```json
{
    "success": false,
    "message": "Device token not found"
}
```

---

### 6. Delete Device Token

Permanently delete a device token.

**Endpoint:** `DELETE /device-tokens/{id}`

**Success Response (200):**

```json
{
    "success": true,
    "message": "Device token deleted successfully"
}
```

---

## Notification Management

### 7. Get All Notifications

Retrieve all notifications for the authenticated user with pagination.

**Endpoint:** `GET /notifications`

**Query Parameters:**

-   `is_read` (optional): Filter by read status (true/false)
-   `per_page` (optional): Number of items per page (default: 20)
-   `page` (optional): Page number

**Example:** `GET /notifications?is_read=false&per_page=10&page=1`

**Success Response (200):**

```json
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "user_id": 1,
                "type": "help_request_response",
                "message": "Help is on the way! Emergency services have been dispatched.",
                "is_read": false,
                "created_at": "2026-01-14T10:30:00Z",
                "updated_at": "2026-01-14T10:30:00Z"
            }
        ],
        "first_page_url": "http://api.com/api/v1/notifications?page=1",
        "from": 1,
        "last_page": 5,
        "last_page_url": "http://api.com/api/v1/notifications?page=5",
        "next_page_url": "http://api.com/api/v1/notifications?page=2",
        "path": "http://api.com/api/v1/notifications",
        "per_page": 20,
        "prev_page_url": null,
        "to": 20,
        "total": 100
    }
}
```

---

### 8. Get Unread Notification Count

Get the count of unread notifications.

**Endpoint:** `GET /notifications/unread-count`

**Success Response (200):**

```json
{
    "success": true,
    "data": {
        "unread_count": 5
    }
}
```

---

### 9. Get Specific Notification

Retrieve details of a specific notification.

**Endpoint:** `GET /notifications/{id}`

**Success Response (200):**

```json
{
    "success": true,
    "data": {
        "id": 1,
        "user_id": 1,
        "type": "help_request_response",
        "message": "Help is on the way! Emergency services have been dispatched.",
        "is_read": false,
        "created_at": "2026-01-14T10:30:00Z",
        "updated_at": "2026-01-14T10:30:00Z"
    }
}
```

---

### 10. Mark Notification as Read

Mark a specific notification as read.

**Endpoint:** `POST /notifications/{id}/mark-read`

**Success Response (200):**

```json
{
    "success": true,
    "message": "Notification marked as read",
    "data": {
        "id": 1,
        "user_id": 1,
        "type": "help_request_response",
        "message": "Help is on the way! Emergency services have been dispatched.",
        "is_read": true,
        "created_at": "2026-01-14T10:30:00Z",
        "updated_at": "2026-01-14T11:00:00Z"
    }
}
```

---

### 11. Mark All Notifications as Read

Mark all user's notifications as read.

**Endpoint:** `POST /notifications/mark-all-read`

**Success Response (200):**

```json
{
    "success": true,
    "message": "All notifications marked as read"
}
```

---

### 12. Delete Notification

Delete a specific notification.

**Endpoint:** `DELETE /notifications/{id}`

**Success Response (200):**

```json
{
    "success": true,
    "message": "Notification deleted successfully"
}
```

---

### 13. Delete All Notifications

Delete all user's notifications.

**Endpoint:** `DELETE /notifications/delete-all`

**Success Response (200):**

```json
{
    "success": true,
    "message": "All notifications deleted successfully"
}
```

---

## Help Request Response (Triggers Notification)

### 14. Respond to Help Request

Respond to a help request, which automatically sends a push notification to the requester.

**Endpoint:** `POST /help-requests/{id}/respond`

**Request Body:**

```json
{
    "action": "dispatched", // Required: "acknowledged", "dispatched", "arrived", "completed", "cancelled"
    "note": "Help is on the way!" // Optional
}
```

**Success Response (200):**

```json
{
    "success": true,
    "message": "You have successfully responded to the help request."
}
```

**Error Response (400):**

```json
{
    "success": false,
    "message": "This help request has already been responded to."
}
```

---

## Notification Types

The following notification types are supported:

-   `help_request_response` - Response to a help request
-   `custom` - Custom notification

### Notification Data Payload

When a push notification is sent, it includes additional data:

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

---

## Error Responses

### 401 Unauthorized

```json
{
    "message": "Unauthenticated."
}
```

### 404 Not Found

```json
{
    "message": "No query results for model [Model] ID"
}
```

### 422 Validation Error

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "token": ["The token field is required."]
    }
}
```

---

## Integration Flow

### Initial Setup

1. User logs in and receives authentication token
2. App requests FCM token from Firebase
3. App registers FCM token with backend using `POST /device-tokens`

### Receiving Notifications

1. Backend sends help request response
2. FCM delivers push notification to device
3. User taps notification
4. App navigates to appropriate screen based on notification data

### Logout

1. App calls `POST /device-tokens/deactivate` with current token
2. App deletes local FCM token

---

## Best Practices

1. **Token Registration**: Register device token immediately after login
2. **Token Refresh**: Monitor FCM token refresh events and update backend
3. **Error Handling**: Handle invalid/expired tokens gracefully
4. **Notification Count**: Display unread notification count badge
5. **Background Handling**: Implement proper background notification handlers
6. **Deep Linking**: Navigate to relevant screens when notification is tapped
7. **Cleanup**: Deactivate tokens on logout to prevent unnecessary notifications
