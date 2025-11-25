@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white">
            Admin Panel
        </h1>
        <p class="text-gray-600 dark:text-gray-400">Logged in as: <span class="font-semibold text-primary">{{ Auth::user()->email }}</span></p>
    </div>
    
    <!-- Success/Message Alert -->
    @if (session('success'))
        <div class="bg-green-100 dark:bg-green-900 border-l-4 border-green-500 dark:border-green-400 text-green-700 dark:text-green-300 p-4 mb-6 rounded-lg" role="alert">
            <p class="font-bold">Success!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif


    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <!-- Add Product Card -->
        <a href="{{ route('admin.products.create') }}" class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-primary flex flex-col items-center justify-center text-center transform hover:scale-[1.02] dark:hover:shadow-2xl">
            <svg class="h-10 w-10 text-primary mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Add New Product</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Create a new listing.</p>
        </a>

        <!-- Total Products Card -->
        <a href="{{ route('admin.products.index') }}" class="block bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg border-t-4 border-blue-500 hover:shadow-xl transition duration-300 transform hover:scale-[1.02] dark:hover:shadow-2xl">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Total Products</h2>
            <p class="text-4xl font-extrabold text-blue-600 dark:text-blue-400">{{ $productCount ?? '0' }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">View all listed items.</p>
        </a>

        <!-- Pending Orders Card (Linked to Order Index) -->
        <a href="{{ route('admin.orders.index') }}" class="block bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg border-t-4 border-yellow-500 hover:shadow-xl transition duration-300 transform hover:scale-[1.02] dark:hover:shadow-2xl">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Pending Orders</h2>
            <p class="text-4xl font-extrabold text-yellow-600 dark:text-yellow-400">{{ $pendingOrdersCount }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Items awaiting shipment.</p>
        </a>

        <!-- Low Stock Alerts Card (Linked to Low Stock Alerts) -->
        <a href="{{ route('admin.products.lowStock') }}" class="block bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg border-t-4 border-red-500 hover:shadow-xl transition duration-300 transform hover:scale-[1.02] dark:hover:shadow-2xl">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Low Stock Alerts</h2>
            <p class="text-4xl font-extrabold text-red-600 dark:text-red-400">{{ $lowStockCount }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Products below safety stock.</p>
        </a>
    </div>

    <!-- Product Quick List Section (UPDATED) -->
    <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 border-b dark:border-gray-700 pb-2">
            Recent Products Quick List
        </h2>
        
        <!-- Search Form for Quick List (REMOVED REDIRECT TEXT) -->
        <form action="{{ route('admin.products.index') }}" method="GET" class="relative mb-6 max-w-lg">
            <input type="text" name="query" placeholder="Search Inventory" 
                   class="w-full py-2 pl-10 pr-4 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-primary focus:border-primary transition duration-150">
            <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($recentProducts as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $product->category }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($product->stock <= 10) bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                    @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @endif">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-primary hover:text-green-700 transition duration-150">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No products found. <a href="{{ route('admin.products.create') }}" class="text-primary hover:underline">Add product.</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4 text-right">
             <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-primary hover:underline">
                View Full Inventory &rarr;
            </a>
        </div>
    </div>
    
</div>
@endsection