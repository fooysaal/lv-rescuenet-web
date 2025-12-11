<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', 'RescueNet - Stay Safe, Stay Informed, Stay Connected | দুর্যোগ মোকাবেলা প্ল্যাটফর্ম')
    </title>
    <meta name="description"
        content="RescueNet is a disaster-response platform designed to help citizens, volunteers, and authorities stay informed and stay safe during emergencies.">

    <!-- Google Fonts for English and Bangla -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Noto+Sans+Bengali:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Modern font stack with Bangla support */
        body {
            font-family: 'Inter', 'Noto Sans Bengali', system-ui, -apple-system, sans-serif;
        }

        .font-bangla {
            font-family: 'Noto Sans Bengali', 'Inter', sans-serif;
        }

        /* Modern glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Modern gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Smooth gradient animations */
        .animated-gradient {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Modern card hover effects */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
        }

        /* Glowing border effect */
        .glow-border {
            position: relative;
            overflow: hidden;
        }

        .glow-border::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 2px;
            background: linear-gradient(45deg, #667eea, #764ba2, #f093fb, #4facfe);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .glow-border:hover::before {
            opacity: 1;
        }

        /* Particle background */
        .particle-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        /* Modern shadow variations */
        .shadow-modern {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .shadow-modern-lg {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Language toggle animation */
        .lang-hidden {
            display: none;
        }

        .lang-fade {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="antialiased bg-white text-gray-900">

    @yield('content')

</body>

</html>
