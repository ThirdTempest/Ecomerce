@extends('layouts.app')

@section('title', 'Order Placed!')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 flex justify-center items-center min-h-[calc(100vh-100px)]">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-8 max-w-md w-full text-center border border-gray-100 dark:border-gray-700">
        <div class="text-green-500 mx-auto w-24 h-24 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-700/30 mb-6">
            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>

        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4">
            Order Placed!
        </h1>

        <p class="text-lg text-gray-700 dark:text-gray-300 mb-8">
            Thank you for your purchase. Your payment was successfully processed.
        </p>

        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 mb-8">
            <p class="text-xl font-semibold text-green-700 dark:text-green-300 mb-2">
                Your Order Number is: <span class="font-extrabold">{{ $mock_order_number }}</span>
            </p>
        </div>
        
        <a href="{{ route('profile') }}" class="w-full inline-block py-3 px-6 rounded-lg shadow-md text-lg font-bold text-white bg-primary hover:bg-green-700 transition duration-300 transform hover:scale-[1.01] mb-4">
            View My Orders
        </a>

        <a href="{{ route('shop') }}" class="block text-center text-gray-600 dark:text-gray-400 hover:text-primary transition duration-300">
            Continue Shopping
        </a>
    </div>
</div>
@endsection