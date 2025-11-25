@extends('layouts.app')

@section('title', 'Admin Product Listing')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header with Action Buttons -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white">
            Product Inventory
        </h1>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary transition duration-150 flex items-center">
                &larr; Dashboard
            </a>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-primary hover:bg-green-700 transition duration-150">
                + Add New Product
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 dark:bg-green-900 border-l-4 border-green-500 dark:border-green-400 text-green-700 dark:text-green-300 p-4 mb-6 rounded-lg" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Search Bar (NEW) -->
    <form action="{{ route('admin.products.index') }}" method="GET" class="relative mb-6 max-w-xl mx-auto">
        <input type="text" name="query" placeholder="Search product name or category..." 
               class="w-full py-3 pl-12 pr-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-primary focus:border-primary transition duration-150" 
               value="{{ $searchQuery ?? '' }}">
        <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </button>
        @if ($searchQuery)
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 text-center">
                Showing results for: <span class="font-semibold">"{{ $searchQuery }}"</span>
            </p>
        @endif
    </form>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden dark:shadow-2xl">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-1/4">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Price (₱)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-20">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $product->category }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 font-semibold">
                                ₱{{ number_format($product->price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($product->stock <= 10) bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                    @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @endif">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-primary hover:text-green-700 transition duration-150">Edit</a>
                                {{-- Delete Form placeholder here in a real app --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                No products found. <a href="{{ route('admin.products.create') }}" class="text-primary hover:underline">Add one now!</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="p-4 bg-gray-50 dark:bg-gray-900 border-t dark:border-gray-700">
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection