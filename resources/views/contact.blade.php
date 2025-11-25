@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-10 bg-white dark:bg-gray-800 p-8 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700">
        
        <!-- Contact Information (1/3) -->
        <div class="lg:col-span-1 bg-primary text-white p-6 rounded-lg flex flex-col justify-between shadow-lg">
            <div>
                <h2 class="text-3xl font-extrabold mb-4">Get In Touch</h2>
                <p class="text-lg opacity-90 mb-8">We'd love to hear from you. Fill out the form or reach us directly using the details below.</p>
            </div>

            <div class="space-y-4">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span>support@eshop.ph</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.42 5.42l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-4.477c-2.18 0-4.32-.57-6.23-1.63L3 17V5z"></path></svg>
                    <span>(02) 8XXX-XXXX</span>
                </div>
                <div class="flex items-start">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>Mandaue, Cebu, Philippines</span>
                </div>
            </div>
        </div>

        <!-- Contact Form (2/3) -->
        <div class="lg:col-span-2 space-y-6">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 border-b dark:border-gray-700 pb-2">Send Us a Message</h3>

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                @csrf
                
                @if (session('success'))
                    <div class="bg-green-100 dark:bg-green-900/50 border-l-4 border-green-500 dark:border-green-400 text-green-700 dark:text-green-300 p-4 rounded-lg" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="bg-red-100 dark:bg-red-900/50 border border-red-400 dark:border-red-500 text-red-700 dark:text-red-300 px-4 py-3 rounded relative" role="alert">
                        <p class="font-bold">Error:</p>
                        <p>Please fix the errors below.</p>
                    </div>
                @endif
                
                <!-- Name and Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-3 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white @error('name') border-red-500 @enderror"
                            value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}"
                        >
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                        <input type="email" name="email" id="email" required
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-3 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror"
                            value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                        >
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject</label>
                    <input type="text" name="subject" id="subject" required
                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-3 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white @error('subject') border-red-500 @enderror"
                        value="{{ old('subject') }}"
                    >
                    @error('subject')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Message -->
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                    <textarea id="message" name="message" rows="5" required
                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-3 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white @error('message') border-red-500 @enderror"
                    >{{ old('message') }}</textarea>
                    @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full py-3 px-4 border border-transparent rounded-lg shadow-lg text-lg font-medium text-white bg-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-150"
                    >
                        Submit Inquiry
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection