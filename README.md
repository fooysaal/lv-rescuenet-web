<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# RescueNet Web Backend

A comprehensive emergency response and rescue coordination platform backend built with Laravel 12. RescueNet connects people in distress with nearby rescue teams and emergency responders, facilitating rapid response through real-time communication and location-based services.

---

## 🚨 About RescueNet

RescueNet is designed to streamline emergency response operations by providing a centralized platform for:

- **Emergency Help Requests**: Users can submit urgent help requests with location data, attachments, and detailed information
- **Organization & Team Management**: Emergency response organizations can manage multiple teams and coordinate resources effectively
- **Real-time Notifications**: Instant push notifications keep responders informed of new emergencies and updates
- **Geographic Coordination**: Location-based services help dispatch the nearest available teams
- **Request Tracking**: Complete lifecycle management of help requests from submission to resolution
- **Emergency Contacts**: Users can maintain emergency contact information for rapid communication

---

## ✨ Core Features

### Emergency Management

- 📍 Location-based help request submission
- 📎 Support for multimedia attachments (photos, videos, documents)
- 🔄 Real-time request status tracking and logging
- 🚩 Request flagging and reporting system
- 📊 Request history and analytics

### Organization & Team Coordination

- 🏢 Multi-organization support with role-based access
- 👥 Team creation and member management
- 👤 User assignment to organizations and teams
- 📋 Customizable user profiles with emergency information

### Communication & Notifications

- 🔔 Push notifications via Firebase Cloud Messaging (FCM)
- 📱 Multi-device notification support
- ✉️ In-app notification management
- ✅ Read/unread status tracking
- 🔄 Automatic device token management

### Location Services

- 🌍 Support for countries, states/divisions, and districts
- 📍 Geographic-based team and request matching
- 🗺️ Location data integration for help requests

---

## 🔔 Push Notifications Setup

This project includes complete Firebase Cloud Messaging (FCM) integration for real-time notifications.

### Quick Setup

👉 **[QUICK_START.md](QUICK_START.md)** - Get started in 20 minutes

### Documentation

- 📚 **[FIREBASE_SETUP.md](FIREBASE_SETUP.md)** - Complete Firebase & Flutter setup guide
- 📖 **[PUSH_NOTIFICATION_API.md](PUSH_NOTIFICATION_API.md)** - API reference with examples
- 📝 **[IMPLEMENTATION_SUMMARY.md](IMPLEMENTATION_SUMMARY.md)** - Implementation details
- 💻 **[flutter_notification_service.dart](flutter_notification_service.dart)** - Flutter integration sample

### Notification Features

- ✅ Multi-device push notifications via FCM
- ✅ Real-time help request response notifications
- ✅ In-app notification management
- ✅ Automatic token refresh handling
- ✅ Invalid token cleanup
- ✅ Read/unread status tracking

---

## 🚀 Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js & NPM
- Firebase account (for push notifications)

### Installation

1. Clone the repository

```bash
git clone https://github.com/fooysaal/lv-rescuenet-web.git
cd lv-rescuenet-web
```

2. Install dependencies

```bash
composer install
npm install
```

3. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

4. Set up database

```bash
php artisan migrate --seed
```

5. Build assets

```bash
npm run build
```

6. Start the development server

```bash
php artisan serve
```

For detailed Docker setup instructions, see [DOCKER.md](DOCKER.md).

---

## 📚 API Documentation

The API follows RESTful principles and uses Laravel Sanctum for authentication. Test the endpoints using the included Postman collection:

- **[postman_collection.json](postman_collection.json)** - Complete API collection

### Key API Endpoints

- `/api/auth/*` - Authentication & user registration
- `/api/help-requests/*` - Emergency help request management
- `/api/organizations/*` - Organization management
- `/api/teams/*` - Team management
- `/api/notifications/*` - Notification management
- `/api/device-tokens/*` - Device token registration for push notifications

---

## 🛠️ Technology Stack

- **Framework**: Laravel 12
- **Database**: MySQL/MariaDB
- **Authentication**: Laravel Sanctum
- **Push Notifications**: Firebase Cloud Messaging (FCM)
- **Real-time UI**: Livewire
- **Frontend Build**: Vite
- **API Testing**: Postman
- **Containerization**: Docker (optional)

---

## 🤝 Contributing

Contributions are welcome! Please follow these guidelines:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

Please ensure your code follows PSR-12 coding standards and includes appropriate tests.

---

## 🔒 Security Vulnerabilities

If you discover a security vulnerability within RescueNet, please send an email to the development team. All security vulnerabilities will be promptly addressed.

**Please do not create public GitHub issues for security vulnerabilities.**

## 📄 License

RescueNet is open-source software. Please check with the project maintainers for licensing information.

---

## 🙏 Acknowledgments

Built with [Laravel](https://laravel.com) - The PHP Framework for Web Artisans

---

**RescueNet** - Connecting help where it's needed most.
