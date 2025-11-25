@extends('layouts.app')

@section('title', 'Payment Failed')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-10 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700 text-center">
        
        <!-- Failure Icon -->
        <svg class="mx-auto h-20 w-20 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mt-4 mb-2">
            Payment Issue
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
            Your payment could not be processed, or the transaction was cancelled. Please try again or contact support.
        </p>

        <div class="space-y-4">
            <a href="{{ route('cart.view') }}" class="w-full inline-block py-3 px-6 rounded-lg font-bold text-white bg-red-600 hover:bg-red-700 transition duration-150 shadow-md">
                Return to Cart
            </a>
            <a href="{{ route('shop') }}" class="w-full inline-block text-gray-600 dark:text-gray-400 hover:text-primary transition duration-150">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection