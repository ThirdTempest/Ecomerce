@extends('layouts.app')

@section('title', 'Welcome to E-SHOP - Your Online Clothing Store')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div id="hero-slider" class="relative bg-primary text-white rounded-xl shadow-lg p-12 mb-16 flex items-center justify-center min-h-[450px] overflow-hidden">
        
        <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out banner-slide" 
             style="background-image: url('/assets/banners/banner-1.jpg');"></div>
       <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-0 banner-slide" 
             style="background-image: url('/assets/banners/banner-2.jpg');"></div>
        <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-0 banner-slide" 
             style="background-image: url('/assets/banners/banner-3.jpg');"></div>
        
        <div class="absolute inset-0 bg-black opacity-40 z-10"></div>

       <div class="relative z-20 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
                Your Next Signature Look Starts Here.
            </h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto">
                Explore curated collections that blend global fashion trends with everyday Philippine comfort.
                Elevate your wardrobe today.
            </p>
        </div>
    </div>

    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Shop By Department</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-16 max-w-4xl mx-auto">
        @php
            $categories = [
                ['name' => 'Man\'s Clothing', 'image_url' => '/assets/categories/men.jpg'],
                ['name' => 'Women\'s Clothing', 'image_url' => '/assets/categories/women.jpg'],
                ['name' => 'Children\'s Clothing', 'image_url' => '/assets/categories/kids.jpg'],
            ];
        @endphp

        @foreach ($categories as $category)
            <a href="{{ route('shop') }}?category={{ urlencode($category['name']) }}" 
               class="group relative block h-80 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                     style="background-image: url('{{ $category['image_url'] }}');">
                </div>
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>

                <div class="absolute bottom-0 left-0 p-6 w-full text-white">
                    <h3 class="text-3xl font-bold mb-2 tracking-tight">{{ $category['name'] }}</h3>
                   <div class="flex items-center text-sm font-medium text-white/90 group-hover:text-white transition-colors">
                        <span>View Collection</span>
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                 </div>
            </a>
        @endforeach
    </div>
</div>
<div class="py-12 mt-10"> 
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">New Arrivals</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8"> 
        @forelse ($newArrivals as $product)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-2xl transform hover:-translate-y-1 relative 
                        dark:border dark:border-gray-700 dark:hover:border-primary">
                @if ($product->sale_price !== null)
                    <span class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md z-10">
                        SALE!
                    </span>
                @endif
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                <div class="p-5">
                    <p class="text-sm font-medium text-primary uppercase tracking-wider mb-1">{{ $product->category }}</p>
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-3 truncate" title="{{ $product->name }}">
                        {{ $product->name }}
                    </h4>
                    <div class="flex items-end justify-between mt-4">
                        
                        <div class="flex-grow">
                            @if ($product->sale_price !== null)
                                <div class="flex items-baseline space-x-2">
                                    <span class="text-sm font-medium text-gray-500 line-through dark:text-gray-400">
                                        ₱{{ number_format($product->price, 2) }}
                                    </span>
                                    <span class="text-2xl font-bold text-red-600 dark:text-red-400">
                                        ₱{{ number_format($product->sale_price, 2) }}
                                    </span>
                                </div>
                            @else
                                <span class="text-2xl font-bold text-gray-800 dark:text-white">
                                    ₱{{ number_format($product->price, 2) }}
                                </span>
                            @endif
                            
                            @if ($product->stock <= 0)
                                <p class="text-xs font-semibold text-red-600 dark:text-red-400 mt-1">OUT OF STOCK</p>
                            @elseif ($product->stock <= 5)
                                <p class="text-xs font-semibold text-yellow-600 dark:text-yellow-400 mt-1">Low Stock ({{ $product->stock }})</p>
                            @endif
                        </div>
                        
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-shrink-0">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            @if ($product->stock > 0)
                                <button type="submit" class="bg-primary text-white text-base py-2 px-4 rounded-full hover:bg-green-700 
                                    transition duration-300 shadow-md">
                                    Add to Cart
                                </button>
                            @else
                                <button type="button" disabled class="bg-gray-400 text-white text-base py-2 px-4 rounded-full shadow-md cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full p-10 bg-gray-100 dark:bg-gray-700 rounded-xl border-dashed border-2 border-gray-300 dark:border-gray-600 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <p class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No New Products Available</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    We are currently updating our catalog with
                    exciting new arrivals! Check back soon.
                </p>
                @auth
                    @if (Auth::user()->is_admin)
                        <p class="mt-4 text-sm font-semibold text-primary">
                            (Admin
                            View: Catalog is empty.)
                        </p>
                        <a href="{{ route('admin.products.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-green-700 transition duration-150">
                            Add Your
                            First Product
                        </a>
                    @endif
                @endauth
            </div>
        @endforelse
        </div>

        @if ($newArrivals->isNotEmpty())
            <div class="mt-8 text-center">
                <a href="{{ route('new.arrivals') }}" class="text-lg font-medium text-primary hover:underline">
                    View All New Arrivals &rarr;
                </a>
            </div>
        @endif
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.banner-slide');
        if (images.length === 0) return;

        let currentIndex = 0;

        function showImage(index) {
            images.forEach((img, i) => {
                if (i === index) {
                   img.classList.remove('opacity-0');
                    img.classList.add('opacity-100');
                } else {
                    img.classList.remove('opacity-100');
                    img.classList.add('opacity-0');
                }
            });
        }

        // Initialize: Ensure only the first image is visible on load
        showImage(currentIndex);

        // Cycle to the next image every 5 seconds
        setInterval(() => {
            currentIndex = (currentIndex + 1)
             % images.length;
            showImage(currentIndex);
        }, 5000);
    });
</script>
@endpush
@endsection