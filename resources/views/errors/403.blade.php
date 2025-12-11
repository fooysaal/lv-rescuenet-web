@extends('errors::layout')

@section('code', '403')
@section('title', 'Forbidden')
@section('title_bn', 'নিষিদ্ধ')

@section('icon')
    <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
    </svg>
@endsection

@section('message')
    Sorry, you don't have permission to access this resource. If you believe this is an error, please contact the
    administrator.
@endsection

@section('message_bn')
    দুঃখিত, এই রিসোর্সটি অ্যাক্সেস করার অনুমতি আপনার নেই। যদি আপনি মনে করেন এটি একটি ত্রুটি, তাহলে অনুগ্রহ করে প্রশাসকের
    সাথে যোগাযোগ করুন।
@endsection

@section('additional_content')
    <div class="pt-8">
        <div class="glass p-6 rounded-2xl border border-white/10 max-w-xl mx-auto">
            <div class="flex items-start space-x-4">
                <svg class="w-6 h-6 text-blue-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <div class="text-left">
                    <h3 class="lang-en text-white font-semibold mb-2">Access Denied</h3>
                    <h3 class="lang-bn lang-hidden text-white font-semibold mb-2 font-bangla">অ্যাক্সেস প্রত্যাখ্যাত</h3>
                    <p class="lang-en text-gray-300 text-sm">
                        This area is restricted. Please log in with appropriate credentials to continue.
                    </p>
                    <p class="lang-bn lang-hidden text-gray-300 text-sm font-bangla">
                        এই এলাকাটি সীমাবদ্ধ। অনুগ্রহ করে চালিয়ে যেতে উপযুক্ত শংসাপত্র দিয়ে লগ ইন করুন।
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
