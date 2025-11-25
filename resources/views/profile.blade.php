@extends('layouts.app')

@section('title', 'My Account Dashboard')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700">
        
        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">
            Welcome, {{ Auth::user()->name }}!
        </h1>
        <p class="text-xl text-primary mb-8">
            This is your E-SHOP Account Dashboard.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Navigation Sidebar -->
            <div class="md:col-span-1 space-y-2">
                <a href="{{ route('profile') }}" class="block p-3 rounded-lg bg-primary text-white font-semibold shadow-md">
                    Account Overview
                </a>
                <a href="{{ route('profile.orders') }}" class="block p-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150">
                    Order History
                </a>
                <a href="{{ route('profile.addresses') }}" class="block p-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150">
                    Saved Addresses
                </a>
                
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="pt-4">
                    @csrf
                    <button type="submit" class="block w-full text-left p-3 rounded-lg text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20 font-semibold transition duration-150">
                        Sign Out
                    </button>
                </form>
            </div>

            <!-- Content Area -->
            <div class="md:col-span-2">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 border-b dark:border-gray-700 pb-2">Personal Information</h2>
                
                <div class="space-y-4">
                    <!-- User Name -->
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <div class="w-full sm:w-1/3 font-medium text-gray-500 dark:text-gray-400">Full Name:</div>
                        <div class="w-full sm:w-2/3 text-lg font-semibold text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                    </div>
                    
                    <!-- User Email -->
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <div class="w-full sm:w-1/3 font-medium text-gray-500 dark:text-gray-400">Email:</div>
                        <div class="w-full sm:w-2/3 text-lg font-semibold text-gray-800 dark:text-white">{{ Auth::user()->email }}</div>
                    </div>

                    <!-- Member Since -->
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <div class="w-full sm:w-1/3 font-medium text-gray-500 dark:text-gray-400">Member Since:</div>
                        <div class="w-full sm:w-2/3 text-lg font-semibold text-gray-800 dark:text-white">{{ Auth::user()->created_at->format('M d, Y') }}</div>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t dark:border-gray-700">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Recent Orders</h2>
                    
                    @forelse ($recentOrders as $order)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-3 shadow-sm mb-3 dark:bg-gray-700/50">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-white">Order #{{ $order->order_number }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total: <span class="font-bold text-primary">₱{{ number_format($order->total_amount, 2) }}</span></p>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full 
                                    @if($order->status === 'processing' || $order->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-300
                                    @elseif($order->status === 'shipped') bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-300
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-300
                                    @else bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-300
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <!-- Default Message if no recent orders are found -->
                        <p class="text-gray-600 dark:text-gray-400">You have no recent orders yet. <a href="{{ route('profile.orders') }}" class="text-primary hover:underline">View all orders</a> or <a href="{{ route('shop') }}" class="text-primary hover:underline">Start shopping now!</a></p>
                    @endforelse

                    @if ($recentOrders->isNotEmpty())
                        <div class="mt-4 text-right">
                            <a href="{{ route('profile.orders') }}" class="text-sm font-medium text-primary hover:underline">
                                View All Orders &rarr;
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection