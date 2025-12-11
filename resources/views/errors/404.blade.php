<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | RescueNet</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+Bengali:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* 404-specific animations */
        @keyframes float404 {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        .float-404 {
            animation: float404 3s ease-in-out infinite;
        }

        @keyframes pulse404 {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .pulse-404 {
            animation: pulse404 2s ease-in-out infinite;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .shake-on-hover:hover {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 min-h-screen font-sans overflow-x-hidden">

    <!-- Animated Background Blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="fixed top-0 w-full z-50 backdrop-blur-md bg-white/5 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-red-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">RescueNet</h1>
                        <p class="text-xs text-gray-400 lang-en">Disaster Response</p>
                        <p class="text-xs text-gray-400 lang-bn lang-hidden font-bangla">দুর্যোগ প্রতিক্রিয়া</p>
                    </div>
                </div>

                <!-- Desktop Language Toggle -->
                <div class="hidden md:flex items-center space-x-4">
                    <button id="langToggle"
                        class="px-4 py-2 glass hover:bg-white/10 transition-all duration-300 rounded-lg text-white text-sm font-medium">
                        <span class="lang-en">বাংলা / EN</span>
                        <span class="lang-bn lang-hidden font-bangla">EN / বাংলা</span>
                    </button>
                    <a href="/"
                        class="px-6 py-2.5 bg-gradient-to-r from-red-500 to-purple-600 hover:from-red-600 hover:to-purple-700 text-white rounded-lg font-medium transition-all duration-300 shadow-lg hover:shadow-xl shake-on-hover">
                        <span class="lang-en">Go Home</span>
                        <span class="lang-bn lang-hidden font-bangla">হোম পেজে যান</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="md:hidden p-2 rounded-lg glass hover:bg-white/10 transition-all">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden glass border-t border-white/10">
            <div class="px-4 py-4 space-y-3">
                <button id="langToggleMobile"
                    class="w-full px-4 py-2 glass hover:bg-white/10 transition-all duration-300 rounded-lg text-white text-sm font-medium text-center">
                    <span class="lang-en">বাংলা / EN</span>
                    <span class="lang-bn lang-hidden font-bangla">EN / বাংলা</span>
                </button>
                <a href="/"
                    class="block w-full px-6 py-2.5 bg-gradient-to-r from-red-500 to-purple-600 hover:from-red-600 hover:to-purple-700 text-white rounded-lg font-medium transition-all duration-300 shadow-lg text-center">
                    <span class="lang-en">Go Home</span>
                    <span class="lang-bn lang-hidden font-bangla">হোম পেজে যান</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- 404 Error Content -->
    <main class="relative min-h-screen flex items-center justify-center px-4 pt-20 pb-12">
        <div class="max-w-4xl mx-auto text-center space-y-8">

            <!-- 404 Number with Animation -->
            <div class="float-404 mb-8">
                <div class="relative inline-block">
                    <h1
                        class="text-[180px] md:text-[250px] font-black text-transparent bg-clip-text bg-gradient-to-r from-red-400 via-purple-500 to-pink-500 leading-none drop-shadow-2xl">
                        404
                    </h1>
                    <!-- Glowing effect -->
                    <div
                        class="absolute inset-0 text-[180px] md:text-[250px] font-black text-red-500/20 blur-2xl -z-10">
                        404
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div class="glass p-8 md:p-12 rounded-3xl border border-white/20 backdrop-blur-xl shadow-2xl space-y-6">
                <!-- Icon -->
                <div
                    class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-red-500/20 to-purple-600/20 border border-red-500/30 pulse-404">
                    <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <!-- Heading -->
                <div>
                    <h2 class="lang-en text-4xl md:text-5xl font-bold text-white mb-4">
                        Page Not Found
                    </h2>
                    <h2 class="lang-bn lang-hidden text-4xl md:text-5xl font-bold text-white mb-4 font-bangla">
                        পেজ খুঁজে পাওয়া যায়নি
                    </h2>

                    <p class="lang-en text-lg md:text-xl text-gray-300 max-w-2xl mx-auto">
                        Oops! The page you're looking for seems to have gone missing during our rescue operations. Don't
                        worry, we'll help you get back on track.
                    </p>
                    <p class="lang-bn lang-hidden text-lg md:text-xl text-gray-300 max-w-2xl mx-auto font-bangla">
                        উপস! আপনি যে পেজটি খুঁজছেন সেটি আমাদের রেসকিউ অপারেশনের সময় হারিয়ে গেছে বলে মনে হচ্ছে। চিন্তা
                        করবেন না, আমরা আপনাকে সঠিক পথে ফিরিয়ে দেব।
                    </p>
                </div>

                <!-- Error Code Badge -->
                <div
                    class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-red-500/10 border border-red-500/30">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="lang-en text-red-300 font-medium">Error Code: 404 - Not Found</span>
                    <span class="lang-bn lang-hidden text-red-300 font-medium font-bangla">ত্রুটি কোড: ৪০৪ - খুঁজে
                        পাওয়া যায়নি</span>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-6">
                    <!-- Go Home Button -->
                    <a href="/"
                        class="group px-8 py-4 bg-gradient-to-r from-red-500 to-purple-600 hover:from-red-600 hover:to-purple-700 text-white rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-2xl hover:scale-105 flex items-center space-x-2">
                        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="lang-en">Back to Home</span>
                        <span class="lang-bn lang-hidden font-bangla">হোম পেজে ফিরে যান</span>
                    </a>

                    <!-- Go Back Button -->
                    <button onclick="window.history.back()"
                        class="group px-8 py-4 glass hover:bg-white/10 text-white rounded-xl font-semibold transition-all duration-300 border border-white/20 hover:border-white/40 flex items-center space-x-2">
                        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span class="lang-en">Go Back</span>
                        <span class="lang-bn lang-hidden font-bangla">পেছনে যান</span>
                    </button>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="pt-8">
                <p class="lang-en text-gray-400 mb-4">Or explore these pages:</p>
                <p class="lang-bn lang-hidden text-gray-400 mb-4 font-bangla">অথবা এই পেজগুলো দেখুন:</p>

                <div class="flex flex-wrap justify-center gap-3">
                    <a href="/"
                        class="px-4 py-2 glass hover:bg-white/10 text-white rounded-lg transition-all duration-300 border border-white/10 hover:border-white/30 text-sm">
                        <span class="lang-en">🏠 Home</span>
                        <span class="lang-bn lang-hidden font-bangla">🏠 হোম</span>
                    </a>
                    <a href="/about"
                        class="px-4 py-2 glass hover:bg-white/10 text-white rounded-lg transition-all duration-300 border border-white/10 hover:border-white/30 text-sm">
                        <span class="lang-en">ℹ️ About</span>
                        <span class="lang-bn lang-hidden font-bangla">ℹ️ সম্পর্কে</span>
                    </a>
                    <a href="/login"
                        class="px-4 py-2 glass hover:bg-white/10 text-white rounded-lg transition-all duration-300 border border-white/10 hover:border-white/30 text-sm">
                        <span class="lang-en">🔐 Login</span>
                        <span class="lang-bn lang-hidden font-bangla">🔐 লগইন</span>
                    </a>
                </div>
            </div>

            <!-- Fun Message -->
            <div class="pt-4">
                <p class="lang-en text-sm text-gray-500 italic">
                    💡 Tip: Check the URL for typos, or use the navigation above to find what you need.
                </p>
                <p class="lang-bn lang-hidden text-sm text-gray-500 italic font-bangla">
                    💡 টিপস: URL এ কোনো ভুল আছে কিনা চেক করুন, বা আপনার প্রয়োজনীয় জিনিস খুঁজতে উপরের নেভিগেশন ব্যবহার
                    করুন।
                </p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="relative border-t border-white/10 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-gray-400 text-sm text-center md:text-left">
                    <p class="lang-en">© 2025 RescueNet. Disaster Response Platform.</p>
                    <p class="lang-bn lang-hidden font-bangla">© ২০২৫ RescueNet. দুর্যোগ প্রতিক্রিয়া প্ল্যাটফর্ম।</p>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="/" class="text-gray-400 hover:text-white transition-colors text-sm">
                        <span class="lang-en">Privacy</span>
                        <span class="lang-bn lang-hidden font-bangla">গোপনীয়তা</span>
                    </a>
                    <a href="/" class="text-gray-400 hover:text-white transition-colors text-sm">
                        <span class="lang-en">Terms</span>
                        <span class="lang-bn lang-hidden font-bangla">শর্তাবলী</span>
                    </a>
                    <a href="/" class="text-gray-400 hover:text-white transition-colors text-sm">
                        <span class="lang-en">Contact</span>
                        <span class="lang-bn lang-hidden font-bangla">যোগাযোগ</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // The app.js will handle the language toggle functionality
        // This ensures consistency with the landing page
    </script>
</body>

</html>
