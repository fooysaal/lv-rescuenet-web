@extends('errors::layout')

@section('code', '429')
@section('title', 'Too Many Requests')
@section('title_bn', 'অনেক বেশি অনুরোধ')

@section('icon')
    <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
    </svg>
@endsection

@section('message')
    Whoa there! You've sent too many requests in a short period. Please slow down and try again in a few moments.
@endsection

@section('message_bn')
    থামুন! আপনি অল্প সময়ের মধ্যে অনেক বেশি অনুরোধ পাঠিয়েছেন। অনুগ্রহ করে ধীর গতিতে যান এবং কিছুক্ষণের মধ্যে আবার চেষ্টা
    করুন।
@endsection

@section('additional_content')
    <div class="pt-8">
        <div class="glass p-6 rounded-2xl border border-white/10 max-w-xl mx-auto">
            <div class="text-center">
                <div class="inline-flex items-center space-x-2 text-yellow-400 mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="lang-en font-semibold">Rate Limit Exceeded</span>
                    <span class="lang-bn lang-hidden font-semibold font-bangla">হার সীমা অতিক্রম করেছে</span>
                </div>
                <p class="lang-en text-gray-300 text-sm">
                    Please wait a moment before making another request.
                </p>
                <p class="lang-bn lang-hidden text-gray-300 text-sm font-bangla">
                    অনুগ্রহ করে আরেকটি অনুরোধ করার আগে একটু অপেক্ষা করুন।
                </p>
            </div>
        </div>
    </div>
@endsection
