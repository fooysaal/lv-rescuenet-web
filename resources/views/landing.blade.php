<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RescueNet - Stay Safe, Stay Informed, Stay Connected | দুর্যোগ মোকাবেলা প্ল্যাটফর্ম</title>
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
    </style>
</head>

<body class="antialiased bg-white text-gray-900">
    <!-- Modern Navigation with Glassmorphism -->
    <nav class="fixed top-0 w-full glass shadow-modern z-50 border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="text-2xl">🛡️</span>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold gradient-text">RescueNet</h1>
                                <p class="text-xs text-gray-600 font-bangla">রেসকিউনেট</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="ml-10 flex items-center space-x-1">
                        <a href="#hero"
                            class="text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-blue-50">Home</a>
                        <a href="#vision"
                            class="text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-blue-50">Vision</a>
                        <a href="#features"
                            class="text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-blue-50">Features</a>
                        <a href="#how-it-works"
                            class="text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-blue-50">How
                            It Works</a>
                        <a href="#gallery"
                            class="text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-blue-50">Gallery</a>
                        <a href="#community"
                            class="text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-blue-50">Community</a>
                    </div>
                </div>
                <div class="hidden lg:flex items-center gap-3">
                    <button class="px-4 py-2 text-sm font-semibold text-gray-700 hover:text-blue-600 transition">
                        <span class="font-bangla">বাংলা</span> / EN
                    </button>
                    <a href="#download"
                        class="relative overflow-hidden group px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl text-sm font-bold transition-all hover:shadow-lg hover:scale-105">
                        <span class="relative z-10">Download App</span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button type="button" data-mobile-menu-toggle
                        class="text-gray-700 hover:text-blue-600 p-2 rounded-lg hover:bg-blue-50 transition">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div data-mobile-menu class="hidden lg:hidden glass border-t border-white/20">
            <div class="px-4 pt-2 pb-4 space-y-2">
                <a href="#hero"
                    class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-3 rounded-xl text-base font-semibold transition">Home</a>
                <a href="#vision"
                    class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-3 rounded-xl text-base font-semibold transition">Vision</a>
                <a href="#features"
                    class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-3 rounded-xl text-base font-semibold transition">Features</a>
                <a href="#how-it-works"
                    class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-3 rounded-xl text-base font-semibold transition">How
                    It Works</a>
                <a href="#gallery"
                    class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-3 rounded-xl text-base font-semibold transition">Gallery</a>
                <a href="#community"
                    class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-3 rounded-xl text-base font-semibold transition">Community</a>
                <a href="#download"
                    class="block bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:shadow-lg px-4 py-3 rounded-xl text-base font-bold text-center transition">Download
                    App</a>
                <button
                    class="w-full px-4 py-3 text-base font-semibold text-gray-700 hover:bg-blue-50 rounded-xl transition text-center">
                    <span class="font-bangla">বাংলা</span> / English
                </button>
            </div>
        </div>
    </nav>

    <!-- Modern Hero Section with Animated Gradient Background -->
    <section id="hero" class="relative pt-32 pb-24 overflow-hidden">
        <!-- Animated gradient background -->
        <div class="absolute inset-0 animated-gradient opacity-10"></div>

        <!-- Decorative elements -->
        <div
            class="absolute top-20 right-10 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute top-40 left-10 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-1/2 w-96 h-96 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div
                        class="inline-flex items-center gap-2 px-5 py-2.5 glass rounded-full text-sm font-bold shadow-modern">
                        <span class="flex h-2 w-2 relative">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                        </span>
                        <span class="bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent">Disaster
                            Response Platform</span>
                        <span class="mx-2">•</span>
                        <span class="font-bangla text-gray-700">দুর্যোগ মোকাবেলা প্ল্যাটফর্ম</span>
                    </div>

                    <div>
                        <h1 class="text-5xl lg:text-7xl font-black text-gray-900 leading-tight mb-4">
                            <span class="block">Stay Safe.</span>
                            <span class="block">Stay Informed.</span>
                            <span class="block gradient-text">Stay Connected.</span>
                        </h1>
                        <p class="text-2xl font-bold text-gray-800 font-bangla mt-6">
                            নিরাপদ থাকুন। সচেতন থাকুন। সংযুক্ত থাকুন।
                        </p>
                    </div>

                    <p class="text-xl text-gray-600 leading-relaxed">
                        Helping communities stay safe, stay informed, and stay connected during emergencies. RescueNet
                        is your lifeline during natural disasters.
                    </p>

                    <p class="text-lg text-gray-600 leading-relaxed font-bangla">
                        জরুরি অবস্থায় সম্প্রদায়কে নিরাপদ, সচেতন এবং সংযুক্ত রাখতে সাহায্য করা। প্রাকৃতিক দুর্যোগের
                        সময় RescueNet আপনার জীবনরেখা।
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="#download"
                            class="group relative overflow-hidden inline-flex items-center justify-center px-10 py-5 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 bg-size-200 bg-pos-0 hover:bg-pos-100 text-white rounded-2xl text-lg font-bold transition-all duration-500 shadow-modern-lg hover:shadow-xl hover:scale-105">
                            <span class="relative z-10 flex items-center gap-3">
                                <span class="text-2xl">📱</span>
                                <span>Download App</span>
                            </span>
                        </a>
                        <a href="#features"
                            class="inline-flex items-center justify-center px-10 py-5 glass border-2 border-purple-200 hover:border-purple-400 rounded-2xl text-lg font-bold text-gray-800 hover:shadow-modern transition-all hover:scale-105">
                            <span class="flex items-center gap-3">
                                <span>Learn More</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                        </a>
                    </div>

                    <div class="flex flex-wrap items-center gap-6 pt-4">
                        <div class="flex items-center gap-2 px-4 py-2 glass rounded-lg">
                            <span class="flex h-3 w-3 relative">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                            </span>
                            <span class="text-sm font-semibold text-gray-700">Real-time Alerts</span>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 glass rounded-lg">
                            <span class="text-green-500 text-lg">✓</span>
                            <span class="text-sm font-semibold text-gray-700">Free & Open Source</span>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 glass rounded-lg">
                            <span class="text-blue-500 text-lg">🌍</span>
                            <span class="text-sm font-semibold text-gray-700 font-bangla">বাংলা সমর্থন</span>
                        </div>
                    </div>
                </div>

                <div class="relative lg:block hidden">
                    <div class="relative z-10 glow-border glass rounded-3xl p-8 shadow-modern-lg hover-lift">
                        <div
                            class="aspect-square bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-2xl flex items-center justify-center overflow-hidden">
                            <div class="absolute inset-0 bg-black/10 backdrop-blur-sm"></div>
                            <div class="relative text-center p-8">
                                <div class="text-8xl mb-4 animate-pulse">📱</div>
                                <p class="text-white text-xl font-bold">Mobile App Preview</p>
                                <p class="text-white/80 text-sm mt-2 font-bangla">শীঘ্রই আসছে</p>
                                <p class="text-white/60 text-sm">Coming Soon</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Vision & Mission Section -->
    <section id="vision"
        class="py-32 bg-gradient-to-br from-gray-50 via-white to-blue-50 relative overflow-hidden">
        <!-- Decorative background -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-300 rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-300 rounded-full filter blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <div
                    class="inline-flex items-center gap-2 px-5 py-2 glass rounded-full text-sm font-bold mb-6 shadow-modern">
                    <span class="text-purple-600">✨</span>
                    <span>Our Vision</span>
                    <span class="mx-1">•</span>
                    <span class="font-bangla">আমাদের দৃষ্টিভঙ্গি</span>
                </div>
                <h2 class="text-5xl lg:text-6xl font-black text-gray-900 mb-6">
                    Vision & Mission
                </h2>
                <p class="text-2xl font-bold text-gray-800 font-bangla mb-4">
                    দৃষ্টিভঙ্গি ও লক্ষ্য
                </p>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Building a resilient future where every community has the tools and information needed to survive
                    and thrive during emergencies.
                </p>
                <p class="text-lg text-gray-600 max-w-4xl mx-auto leading-relaxed font-bangla mt-3">
                    একটি স্থিতিস্থাপক ভবিষ্যত তৈরি করা যেখানে প্রতিটি সম্প্রদায়ের জরুরি অবস্থায় টিকে থাকতে এবং উন্নতি
                    করতে প্রয়োজনীয় সরঞ্জাম এবং তথ্য রয়েছে।
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div
                    class="group hover-lift glow-border glass rounded-3xl p-8 shadow-modern hover:shadow-modern-lg transition-all">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <span class="text-3xl">🏘️</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Community Resilience</h3>
                    <p class="text-lg font-semibold text-gray-800 font-bangla mb-3">সম্প্রদায়ের স্থিতিস্থাপকতা</p>
                    <p class="text-gray-600 leading-relaxed">
                        Strengthen community disaster resilience through accessible technology and transparent
                        information sharing.
                    </p>
                    <p class="text-gray-600 leading-relaxed font-bangla mt-2 text-sm">
                        সহজলভ্য প্রযুক্তি এবং স্বচ্ছ তথ্য ভাগাভাগির মাধ্যমে সম্প্রদায়ের দুর্যোগ স্থিতিস্থাপকতা
                        শক্তিশালী করুন।
                    </p>
                </div>

                <!-- Card 2 -->
                <div
                    class="group hover-lift glow-border glass rounded-3xl p-8 shadow-modern hover:shadow-modern-lg transition-all">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <span class="text-3xl">🗺️</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Real-Time Shelter Access</h3>
                    <p class="text-lg font-semibold text-gray-800 font-bangla mb-3">রিয়েল-টাইম আশ্রয়কেন্দ্র অ্যাক্সেস
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Provide instant access to nearby evacuation shelters with live status updates and capacity
                        information.
                    </p>
                    <p class="text-gray-600 leading-relaxed font-bangla mt-2 text-sm">
                        লাইভ স্ট্যাটাস আপডেট এবং ধারণক্ষমতা তথ্য সহ নিকটবর্তী সরিয়ে নেওয়া আশ্রয়কেন্দ্রগুলিতে
                        তাৎক্ষণিক অ্যাক্সেস প্রদান করুন।
                    </p>
                </div>

                <!-- Card 3 -->
                <div
                    class="group hover-lift glow-border glass rounded-3xl p-8 shadow-modern hover:shadow-modern-lg transition-all">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <span class="text-3xl">🤝</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Emergency Coordination</h3>
                    <p class="text-lg font-semibold text-gray-800 font-bangla mb-3">জরুরি সমন্বয়</p>
                    <p class="text-gray-600 leading-relaxed">
                        Connect citizens, volunteers, and authorities for seamless emergency response coordination.
                    </p>
                    <p class="text-gray-600 leading-relaxed font-bangla mt-2 text-sm">
                        নিরবচ্ছিন্ন জরুরি প্রতিক্রিয়া সমন্বয়ের জন্য নাগরিক, স্বেচ্ছাসেবক এবং কর্তৃপক্ষকে সংযুক্ত করুন।
                    </p>
                </div>

                <!-- Card 4 -->
                <div
                    class="group hover-lift glow-border glass rounded-3xl p-8 shadow-modern hover:shadow-modern-lg transition-all">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <span class="text-3xl">📡</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Transparent Information</h3>
                    <p class="text-lg font-semibold text-gray-800 font-bangla mb-3">স্বচ্ছ তথ্য</p>
                    <p class="text-gray-600 leading-relaxed">
                        Promote transparent and accessible disaster information for informed decision-making.
                    </p>
                    <p class="text-gray-600 leading-relaxed font-bangla mt-2 text-sm">
                        অবগত সিদ্ধান্ত গ্রহণের জন্য স্বচ্ছ এবং সহজলভ্য দুর্যোগ তথ্য প্রচার করুন।
                    </p>
                </div>

                <!-- Card 5 -->
                <div
                    class="group hover-lift glow-border glass rounded-3xl p-8 shadow-modern hover:shadow-modern-lg transition-all">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-amber-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <span class="text-3xl">👥</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Volunteer Network</h3>
                    <p class="text-lg font-semibold text-gray-800 font-bangla mb-3">স্বেচ্ছাসেবক নেটওয়ার্ক</p>
                    <p class="text-gray-600 leading-relaxed">
                        Mobilize and coordinate volunteer efforts to maximize community support during crises.
                    </p>
                    <p class="text-gray-600 leading-relaxed font-bangla mt-2 text-sm">
                        সংকটের সময় সর্বাধিক সম্প্রদায়ের সহায়তার জন্য স্বেচ্ছাসেবক প্রচেষ্টা সংগঠিত এবং সমন্বয় করুন।
                    </p>
                </div>

                <!-- Card 6 -->
                <div
                    class="group hover-lift glow-border glass rounded-3xl p-8 shadow-modern hover:shadow-modern-lg transition-all">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <span class="text-3xl">✅</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Safety Confirmation</h3>
                    <p class="text-lg font-semibold text-gray-800 font-bangla mb-3">নিরাপত্তা নিশ্চিতকরণ</p>
                    <p class="text-gray-600 leading-relaxed">
                        Enable quick safety check-ins to reassure loved ones and aid emergency response efforts.
                    </p>
                    <p class="text-gray-600 leading-relaxed font-bangla mt-2 text-sm">
                        প্রিয়জনদের আশ্বস্ত করতে এবং জরুরি প্রতিক্রিয়া প্রচেষ্টায় সহায়তা করতে দ্রুত সুরক্ষা চেক-ইন
                        সক্ষম করুন।
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Showcase Section -->
    <section id="features" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Powerful Features</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Everything you need to stay safe during emergencies, all in one intuitive mobile app.
                </p>
            </div>

            <div class="space-y-20">
                <!-- Feature 1: Nearby Shelters -->
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <div
                            class="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold mb-4">
                            🔹 Core Feature
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Nearby Evacuation Shelters</h3>
                        <p class="text-lg text-gray-600 mb-6">
                            Instantly find the nearest safe evacuation points with real-time information on capacity,
                            status, and accessibility features.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Interactive Map View</strong> - Visual
                                    representation of all nearby shelters</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Distance-Based Sorting</strong> - Closest shelters
                                    shown first</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Detailed Information</strong> - Capacity,
                                    amenities, and current status</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Navigation Integration</strong> - Get directions
                                    with one tap</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <div
                            class="aspect-video bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-5xl mb-3">🗺️</div>
                                <p class="text-gray-600 font-medium">Shelter Map View</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 2: Mark As Safe -->
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="md:order-2">
                        <div
                            class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold mb-4">
                            🔹 Safety First
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">"Mark As Safe" System</h3>
                        <p class="text-lg text-gray-600 mb-6">
                            Let your loved ones know you're safe with one simple tap. Automatic location and timestamp
                            logging keeps everyone informed.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>One-Tap Safety Confirmation</strong> - Quick and
                                    easy check-in</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Auto Location & Timestamp</strong> - Verified
                                    safety records</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Emergency Contact Alerts</strong> - Notify family
                                    automatically</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Privacy Controls</strong> - You decide who sees
                                    your status</span>
                            </li>
                        </ul>
                    </div>
                    <div class="md:order-1 bg-white rounded-2xl shadow-xl p-8">
                        <div
                            class="aspect-video bg-gradient-to-br from-green-100 to-emerald-100 rounded-xl flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-5xl mb-3">✅</div>
                                <p class="text-gray-600 font-medium">Safety Confirmation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 3: Disaster Alerts -->
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <div
                            class="inline-block px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-semibold mb-4">
                            🔹 Critical Updates
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Disaster Alerts & Notifications</h3>
                        <p class="text-lg text-gray-600 mb-6">
                            Receive real-time weather warnings and emergency alerts directly from authorities. Stay
                            ahead of disasters with timely information.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Real-Time Weather Warnings</strong> - Advanced
                                    disaster detection</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Government Emergency Info</strong> - Official
                                    communication channel</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>SMS & PWA Fallback</strong> - Alerts even without
                                    internet</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Location-Based Alerts</strong> - Relevant warnings
                                    for your area</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <div
                            class="aspect-video bg-gradient-to-br from-red-100 to-orange-100 rounded-xl flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-5xl mb-3">🚨</div>
                                <p class="text-gray-600 font-medium">Emergency Alerts</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 4: Report Emergency -->
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="md:order-2">
                        <div
                            class="inline-block px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-semibold mb-4">
                            🔹 Community Action
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Report Emergency or Damage</h3>
                        <p class="text-lg text-gray-600 mb-6">
                            Help your community by reporting incidents with photos and GPS coordinates. Enable faster
                            response from volunteers and authorities.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Photo Documentation</strong> - Visual evidence of
                                    damage</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>GPS Location Tagging</strong> - Precise incident
                                    locations</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Category Classification</strong> - Organize by
                                    incident type</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Priority Levels</strong> - Critical incidents get
                                    immediate attention</span>
                            </li>
                        </ul>
                    </div>
                    <div class="md:order-1 bg-white rounded-2xl shadow-xl p-8">
                        <div
                            class="aspect-video bg-gradient-to-br from-orange-100 to-yellow-100 rounded-xl flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-5xl mb-3">📸</div>
                                <p class="text-gray-600 font-medium">Incident Reporting</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 5: Volunteer Support -->
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <div
                            class="inline-block px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold mb-4">
                            🔹 Together Stronger
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Volunteer & Community Support</h3>
                        <p class="text-lg text-gray-600 mb-6">
                            Join forces with your community. Request help, volunteer your services, and coordinate
                            resource sharing during emergencies.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Help Requests</strong> - Ask for assistance when
                                    needed</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Volunteer Registration</strong> - Offer your skills
                                    and time</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Resource Sharing</strong> - Share food, water,
                                    supplies</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 text-xl">✓</span>
                                <span class="text-gray-700"><strong>Task Coordination</strong> - Organize volunteer
                                    efforts efficiently</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <div
                            class="aspect-video bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-5xl mb-3">🤝</div>
                                <p class="text-gray-600 font-medium">Community Support</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">How It Works</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Simple, intuitive, and designed for emergencies. Here's how RescueNet keeps you safe in 6 easy
                    steps.
                </p>
            </div>

            <div class="relative">
                <!-- Connection Line -->
                <div
                    class="hidden lg:block absolute top-1/2 left-0 right-0 h-1 bg-gradient-to-r from-blue-200 via-blue-400 to-blue-200 transform -translate-y-1/2">
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Step 1 -->
                    <div
                        class="relative bg-white rounded-2xl shadow-lg p-8 border-2 border-blue-100 hover:border-blue-300 transition">
                        <div
                            class="absolute -top-4 -left-4 w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold shadow-lg">
                            1</div>
                        <div class="text-4xl mb-4">📱</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Open App</h3>
                        <p class="text-gray-600">Launch RescueNet on your device. The app automatically detects your
                            current location.</p>
                    </div>

                    <!-- Step 2 -->
                    <div
                        class="relative bg-white rounded-2xl shadow-lg p-8 border-2 border-blue-100 hover:border-blue-300 transition">
                        <div
                            class="absolute -top-4 -left-4 w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold shadow-lg">
                            2</div>
                        <div class="text-4xl mb-4">🗺️</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">View Nearby Shelters</h3>
                        <p class="text-gray-600">See all evacuation shelters near you, sorted by distance with
                            real-time status updates.</p>
                    </div>

                    <!-- Step 3 -->
                    <div
                        class="relative bg-white rounded-2xl shadow-lg p-8 border-2 border-blue-100 hover:border-blue-300 transition">
                        <div
                            class="absolute -top-4 -left-4 w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold shadow-lg">
                            3</div>
                        <div class="text-4xl mb-4">🧭</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Navigate to Safety</h3>
                        <p class="text-gray-600">Get turn-by-turn directions to your chosen shelter using integrated
                            navigation.</p>
                    </div>

                    <!-- Step 4 -->
                    <div
                        class="relative bg-white rounded-2xl shadow-lg p-8 border-2 border-blue-100 hover:border-blue-300 transition">
                        <div
                            class="absolute -top-4 -left-4 w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold shadow-lg">
                            4</div>
                        <div class="text-4xl mb-4">✅</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Mark Yourself Safe</h3>
                        <p class="text-gray-600">Once you arrive, confirm your safety with one tap. Your contacts are
                            automatically notified.</p>
                    </div>

                    <!-- Step 5 -->
                    <div
                        class="relative bg-white rounded-2xl shadow-lg p-8 border-2 border-blue-100 hover:border-blue-300 transition">
                        <div
                            class="absolute -top-4 -left-4 w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold shadow-lg">
                            5</div>
                        <div class="text-4xl mb-4">🚨</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Receive Updates</h3>
                        <p class="text-gray-600">Get real-time disaster alerts, weather warnings, and emergency
                            information from authorities.</p>
                    </div>

                    <!-- Step 6 -->
                    <div
                        class="relative bg-white rounded-2xl shadow-lg p-8 border-2 border-blue-100 hover:border-blue-300 transition">
                        <div
                            class="absolute -top-4 -left-4 w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold shadow-lg">
                            6</div>
                        <div class="text-4xl mb-4">📊</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Community Visibility</h3>
                        <p class="text-gray-600">Authorities and volunteers see aggregated safety data to coordinate
                            better response efforts.</p>
                    </div>
                </div>
            </div>

            <!-- Workflow Visual -->
            <div class="mt-16 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8">
                <div class="flex flex-wrap justify-center items-center gap-4 text-lg font-semibold text-gray-700">
                    <span class="bg-white px-4 py-2 rounded-lg shadow">📱 Open</span>
                    <span class="text-blue-500">→</span>
                    <span class="bg-white px-4 py-2 rounded-lg shadow">🗺️ Locate</span>
                    <span class="text-blue-500">→</span>
                    <span class="bg-white px-4 py-2 rounded-lg shadow">🧭 Navigate</span>
                    <span class="text-blue-500">→</span>
                    <span class="bg-white px-4 py-2 rounded-lg shadow">✅ Confirm</span>
                    <span class="text-blue-500">→</span>
                    <span class="bg-white px-4 py-2 rounded-lg shadow">🚨 Stay Updated</span>
                    <span class="text-blue-500">→</span>
                    <span class="bg-white px-4 py-2 rounded-lg shadow">🛡️ Stay Safe</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">App Screenshots & Mockups</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Get a glimpse of the RescueNet mobile app interface and features.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Gallery Item 1 -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition">
                    <div
                        class="aspect-[9/16] bg-gradient-to-br from-blue-100 to-indigo-200 flex items-center justify-center">
                        <div class="text-center p-8">
                            <div class="text-6xl mb-4">🏠</div>
                            <p class="text-gray-700 font-semibold text-lg">Home Screen</p>
                            <p class="text-gray-600 text-sm mt-2">Quick access to all features</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 2 -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition">
                    <div
                        class="aspect-[9/16] bg-gradient-to-br from-green-100 to-emerald-200 flex items-center justify-center">
                        <div class="text-center p-8">
                            <div class="text-6xl mb-4">🗺️</div>
                            <p class="text-gray-700 font-semibold text-lg">Map View</p>
                            <p class="text-gray-600 text-sm mt-2">Interactive shelter locations</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 3 -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition">
                    <div
                        class="aspect-[9/16] bg-gradient-to-br from-purple-100 to-pink-200 flex items-center justify-center">
                        <div class="text-center p-8">
                            <div class="text-6xl mb-4">✅</div>
                            <p class="text-gray-700 font-semibold text-lg">Safety Check</p>
                            <p class="text-gray-600 text-sm mt-2">Mark yourself safe</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 4 -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition">
                    <div
                        class="aspect-[9/16] bg-gradient-to-br from-orange-100 to-red-200 flex items-center justify-center">
                        <div class="text-center p-8">
                            <div class="text-6xl mb-4">🏢</div>
                            <p class="text-gray-700 font-semibold text-lg">Shelter Details</p>
                            <p class="text-gray-600 text-sm mt-2">Capacity & amenities info</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 5 -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition">
                    <div
                        class="aspect-[9/16] bg-gradient-to-br from-yellow-100 to-amber-200 flex items-center justify-center">
                        <div class="text-center p-8">
                            <div class="text-6xl mb-4">🚨</div>
                            <p class="text-gray-700 font-semibold text-lg">Alerts Screen</p>
                            <p class="text-gray-600 text-sm mt-2">Real-time notifications</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 6 -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition">
                    <div
                        class="aspect-[9/16] bg-gradient-to-br from-teal-100 to-cyan-200 flex items-center justify-center">
                        <div class="text-center p-8">
                            <div class="text-6xl mb-4">📸</div>
                            <p class="text-gray-700 font-semibold text-lg">Report Incident</p>
                            <p class="text-gray-600 text-sm mt-2">Document emergencies</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Section -->
    <section id="community" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Join Our Community</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Be part of a movement to make disaster response more accessible, transparent, and effective for
                    everyone.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl">
                    <div class="text-5xl font-bold text-blue-600 mb-2">10K+</div>
                    <p class="text-gray-600 font-medium">Users Ready to Join</p>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl">
                    <div class="text-5xl font-bold text-green-600 mb-2">500+</div>
                    <p class="text-gray-600 font-medium">Registered Volunteers</p>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl">
                    <div class="text-5xl font-bold text-purple-600 mb-2">100%</div>
                    <p class="text-gray-600 font-medium">Free & Open Source</p>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl p-12 text-center text-white">
                <h3 class="text-3xl font-bold mb-4">Ready to Make a Difference?</h3>
                <p class="text-xl mb-8 opacity-90">Join thousands of citizens, volunteers, and organizations working
                    together for safer communities.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#download"
                        class="inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 rounded-lg text-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                        Become a Volunteer
                    </a>
                    <a href="#download"
                        class="inline-flex items-center justify-center px-8 py-4 bg-blue-700 text-white border-2 border-white rounded-lg text-lg font-semibold hover:bg-blue-800 transition">
                        Partner With Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Download CTA Section -->
    <section id="download" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Get RescueNet App</h2>
            <p class="text-xl text-gray-600 mb-8">
                Download now and be prepared for any emergency. Available on iOS and Android.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                <a href="#"
                    class="inline-flex items-center justify-center px-8 py-4 bg-black text-white rounded-lg text-lg font-semibold hover:bg-gray-800 transition shadow-lg">
                    <span class="mr-3 text-2xl">🍎</span>
                    Download on App Store
                </a>
                <a href="#"
                    class="inline-flex items-center justify-center px-8 py-4 bg-green-600 text-white rounded-lg text-lg font-semibold hover:bg-green-700 transition shadow-lg">
                    <span class="mr-3 text-2xl">🤖</span>
                    Get it on Google Play
                </a>
            </div>
            <p class="text-sm text-gray-500">Coming Soon - Currently in Development</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">🛡️ RescueNet</h3>
                    <p class="text-gray-400">
                        Building resilient communities through accessible disaster response technology.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Features</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#features" class="hover:text-white transition">Shelter Finder</a></li>
                        <li><a href="#features" class="hover:text-white transition">Safety Check-in</a></li>
                        <li><a href="#features" class="hover:text-white transition">Disaster Alerts</a></li>
                        <li><a href="#features" class="hover:text-white transition">Volunteer Network</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">About</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#vision" class="hover:text-white transition">Our Mission</a></li>
                        <li><a href="#how-it-works" class="hover:text-white transition">How It Works</a></li>
                        <li><a href="#community" class="hover:text-white transition">Join Community</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Open Source</a></li>
                        <li><a href="#" class="hover:text-white transition">Contribute</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                <p>&copy; 2025 RescueNet. Built with ❤️ for safer communities. Open Source & Free Forever.</p>
            </div>
        </div>
    </footer>

    <!-- Custom Styles for Animations -->
    <style>
        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</body>

</html>
