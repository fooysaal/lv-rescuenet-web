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
                    <button id="langToggle"
                        class="px-4 py-2 text-sm font-semibold text-gray-700 hover:text-blue-600 transition hover:bg-blue-50 rounded-lg">
                        <span id="langText" class="font-bangla">বাংলা</span> / <span id="langTextEn">EN</span>
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
                <button id="langToggleMobile"
                    class="w-full px-4 py-3 text-base font-semibold text-gray-700 hover:bg-blue-50 rounded-xl transition text-center">
                    <span id="langTextMobile" class="font-bangla">বাংলা</span> / <span
                        id="langTextEnMobile">English</span>
                </button>
            </div>
        </div>
    </nav>
