@extends('layouts.app')

@section('title', 'Low Stock Alerts')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-4xl font-extrabold text-red-700 dark:text-red-400">
            Low Stock Alerts
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

    <div class="bg-red-100 dark:bg-red-900/50 border-l-4 border-red-500 dark:border-red-400 text-red-800 dark:text-red-300 p-4 mb-6 rounded-lg" role="alert">
        <p class="font-bold">Urgent Action Required:</p>
        <p>The following {{ $products->count() }} items have stock levels below or equal to the threshold ({{ $lowStockThreshold }} units).</p>
    </div>

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
                        <tr class="bg-red-50/50 dark:bg-red-900/40 hover:bg-red-100 dark:hover:bg-red-900/60 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $product->category }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 font-semibold">
                                ₱{{ number_format($product->price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-700 font-bold dark:text-red-300">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 dark:bg-red-800/70 text-red-800 dark:text-red-300">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-primary hover:text-green-700 transition duration-150">Restock</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                All inventory levels are healthy (above {{ $lowStockThreshold }} units).
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