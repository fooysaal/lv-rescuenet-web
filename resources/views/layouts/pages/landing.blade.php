@extends('layouts.app')

{{-- title --}}
@section('title', 'RescueNet - Stay Safe, Stay Informed, Stay Connected | দুর্যোগ মোকাবেলা প্ল্যাটফর্ম')

@section('content')
    @include('layouts.pages.components.nav')

    @include('layouts.pages.components.hero')

    @include('layouts.pages.components.mission')

    @include('layouts.pages.components.features')

    @include('layouts.pages.components.how-it-works')

    @include('layouts.pages.components.gallery')

    @include('layouts.pages.components.community')

    @include('layouts.pages.components.cta')

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

@endsection

