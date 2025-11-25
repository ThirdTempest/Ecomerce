@extends('layouts.app')

@section('title', 'Saved Addresses')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700">
        
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-6 border-b dark:border-gray-700 pb-2">
            My Saved Addresses
        </h1>
        <a href="{{ route('profile') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary transition duration-150 mb-6 inline-block">
            &larr; Back to Dashboard
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($addresses as $address)
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-5 shadow-sm bg-gray-50 dark:bg-gray-700/50">
                    <div class="flex justify-between items-start">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $address->type }}</h2>
                        <!-- Edit Button Placeholder -->
                        <button class="text-sm text-primary hover:text-green-700 font-medium">Edit</button>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</p>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $address->address }}</p>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ Auth::user()->email }}</p>
                </div>
            @empty
                <div class="md:col-span-2 text-center p-10 bg-gray-50 dark:bg-gray-700 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">
                    <p class="text-xl font-semibold text-gray-700 dark:text-gray-300">You have no saved addresses yet.</p>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">You can add one during the checkout process.</p>
                </div>
            @endforelse
        </div>
        
    </div>
</div>
@endsection