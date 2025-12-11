@extends('errors::layout')

@section('code', '503')
@section('title', 'Service Unavailable')
@section('title_bn', 'সার্ভিস অনুপলব্ধ')

@section('icon')
    <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
@endsection

@section('message')
    We're currently performing scheduled maintenance to improve your experience. The service will be back online shortly.
    Thank you for your patience!
@endsection

@section('message_bn')
    আমরা বর্তমানে আপনার অভিজ্ঞতা উন্নত করতে নির্ধারিত রক্ষণাবেক্ষণ করছি। সার্ভিসটি শীঘ্রই আবার অনলাইনে ফিরে আসবে। আপনার
    ধৈর্যের জন্য ধন্যবাদ!
@endsection

@section('additional_content')
    <div class="pt-8">
        <div class="glass p-6 rounded-2xl border border-white/10 max-w-xl mx-auto">
            <div class="flex items-center justify-center space-x-3 mb-4">
                <div class="w-3 h-3 bg-yellow-400 rounded-full animate-bounce" style="animation-delay: 0s;"></div>
                <div class="w-3 h-3 bg-yellow-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                <div class="w-3 h-3 bg-yellow-400 rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
            </div>
            <p class="lang-en text-gray-300 text-center">
                Maintenance in progress... We'll be back soon!
            </p>
            <p class="lang-bn lang-hidden text-gray-300 text-center font-bangla">
                রক্ষণাবেক্ষণ চলছে... আমরা শীঘ্রই ফিরে আসব!
            </p>
        </div>
    </div>
@endsection
