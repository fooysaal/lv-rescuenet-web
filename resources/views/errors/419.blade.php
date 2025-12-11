@extends('errors::layout')

@section('code', '419')
@section('title', 'Page Expired')
@section('title_bn', 'পেজ মেয়াদ শেষ')

@section('icon')
    <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
@endsection

@section('message')
    Your session has expired due to inactivity. Please refresh the page and try again to continue your activity.
@endsection

@section('message_bn')
    নিষ্ক্রিয়তার কারণে আপনার সেশন মেয়াদ শেষ হয়ে গেছে। আপনার কার্যক্রম চালিয়ে যেতে অনুগ্রহ করে পেজটি রিফ্রেশ করুন এবং
    আবার চেষ্টা করুন।
@endsection

@section('additional_content')
    <div class="pt-8">
        <div class="glass p-6 rounded-2xl border border-white/10 max-w-xl mx-auto">
            <div class="text-center">
                <button onclick="location.reload()"
                    class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl inline-flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span class="lang-en">Refresh Page</span>
                    <span class="lang-bn lang-hidden font-bangla">পেজ রিফ্রেশ করুন</span>
                </button>
            </div>
        </div>
    </div>
@endsection
