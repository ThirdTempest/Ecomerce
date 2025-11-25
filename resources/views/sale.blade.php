@extends('layouts.app')

@section('title', 'Sale Products')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-extrabold text-red-600 mb-4 text-center dark:text-red-400">
        Unbeatable Deals!
    </h1>
    <p class="text-xl text-gray-600 dark:text-gray-400 mb-10 text-center max-w-2xl mx-auto">
        Shop our biggest discounts before they are gone.
    </p>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        
        @forelse ($products as $product)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-2xl transform hover:-translate-y-1 relative 
                        dark:border dark:border-gray-700 dark:hover:border-primary">
                
                <!-- SALE BADGE -->
                <span class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md z-10">
                    SALE!
                </span>

                <!-- Product Image -->
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                
                <div class="p-5">
                    <!-- Product Category -->
                    <p class="text-sm font-medium text-primary uppercase tracking-wider mb-1">{{ $product->category }}</p>
                    
                    <!-- Product Name -->
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-3 truncate" title="{{ $product->name }}">
                        {{ $product->name }}
                    </h4>
                    
                    <div class="flex flex-col mt-4">
                        <!-- Price -->
                        <div class="flex items-baseline space-x-2">
                            <!-- Original Price (Strikethrough) -->
                            <span class="text-sm font-medium text-gray-500 line-through dark:text-gray-400">
                                ₱{{ number_format($product->price, 2) }}
                            </span>
                            <!-- Sale Price -->
                            <span class="text-3xl font-extrabold text-red-600 dark:text-red-400">
                                ₱{{ number_format($product->sale_price, 2) }}
                            </span>
                        </div>
                        
                        <!-- Action Button (Form) -->
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-4"> 
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="w-full bg-primary text-white text-base py-2 px-4 rounded-full hover:bg-green-700 transition duration-300 shadow-md">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 dark:text-gray-400 text-lg">No products are currently on sale.</p>
        @endforelse

    </div>
</div>
@endsection