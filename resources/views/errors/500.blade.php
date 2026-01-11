@extends('errors::layout')

@section('code', '500')
@section('title', 'Server Error')
@section('title_bn', 'সার্ভার ত্রুটি')

@section('icon')
    <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
    </svg>
@endsection

@section('message')
    Oops! Something went wrong on our server. Our team has been notified and is working to fix the issue. Please try again
    later.
@endsection

@section('message_bn')
    উফ! আমাদের সার্ভারে কিছু সমস্যা হয়েছে। আমাদের টিমকে অবগত করা হয়েছে এবং তারা সমস্যাটি সমাধানের জন্য কাজ করছে। অনুগ্রহ
    করে পরে আবার চেষ্টা করুন।
@endsection

@section('additional_content')
    <div class="pt-8">
        <div class="glass p-6 rounded-2xl border border-white/10 max-w-xl mx-auto">
            <div class="flex items-start space-x-4">
                <svg class="w-6 h-6 text-yellow-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="text-left">
                    <h3 class="lang-en text-white font-semibold mb-2">What can you do?</h3>
                    <h3 class="lang-bn lang-hidden text-white font-semibold mb-2 font-bangla">আপনি কী করতে পারেন?</h3>
                    <ul class="lang-en text-gray-300 text-sm space-y-2">
                        <li>• Wait a few minutes and try again</li>
                        <li>• Clear your browser cache</li>
                        <li>• Contact support if the issue persists</li>
                    </ul>
                    <ul class="lang-bn lang-hidden text-gray-300 text-sm space-y-2 font-bangla">
                        <li>• কয়েক মিনিট অপেক্ষা করুন এবং আবার চেষ্টা করুন</li>
                        <li>• আপনার ব্রাউজার ক্যাশ পরিষ্কার করুন</li>
                        <li>• সমস্যা অব্যাহত থাকলে সাপোর্টের সাথে যোগাযোগ করুন</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
