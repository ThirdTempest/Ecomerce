<footer class="bg-gray-900 dark:bg-gray-950 mt-16 text-white pt-12 pb-6">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Adjusted grid to 4 columns since newsletter is removed -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 border-b border-gray-700 pb-10">
            <!-- Company Info -->
            <div class="col-span-2 md:col-span-1">
                <h3 class="text-xl font-bold mb-4 text-primary">E-SHOP</h3>
                <p class="text-gray-400 dark:text-gray-500 text-sm">
                    Discover quality clothing and modern styles for the whole family, delivered across the Philippines.
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-600 mt-4">Cebu, Mandaue</p>
            </div>

            <!-- Shop Links (UPDATED) -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Shop</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('shop') }}" class="text-gray-400 hover:text-white transition duration-150">Shop All</a></li>
                    <li><a href="{{ route('shop') }}?category={{ urlencode("Man's Clothing") }}" class="text-gray-400 hover:text-white transition duration-150">Men's Apparel</a></li>
                    <li><a href="{{ route('shop') }}?category={{ urlencode("Women's Clothing") }}" class="text-gray-400 hover:text-white transition duration-150">Women's Wear</a></li>
                    <li><a href="{{ route('new.arrivals') }}" class="text-gray-400 hover:text-white transition duration-150">New Arrivals</a></li>
                    <li><a href="{{ route('sale') }}" class="text-red-400 hover:text-red-200 transition duration-150 font-bold">Sale Items</a></li>
                </ul>
            </div>

            <!-- Account & Service Links (UPDATED) -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Account & Help</h4>
                <ul class="space-y-3 text-sm">
                    @auth
                        <li><a href="{{ route('profile') }}" class="text-gray-400 hover:text-white transition duration-150">My Profile</a></li>
                        <li><a href="{{ route('profile.orders') }}" class="text-gray-400 hover:text-white transition duration-150">Order History</a></li>
                        <li><a href="{{ route('cart.view') }}" class="text-gray-400 hover:text-white transition duration-150">View Cart</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition duration-150">Sign In / Register</a></li>
                    @endauth
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition duration-150">Contact Us</a></li>
                </ul>
            </div>

            <!-- Legal (UPDATED WITH ROUTES) -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Legal</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('legal.terms') }}" class="text-gray-400 hover:text-white transition duration-150">Terms of Service</a></li>
                    <li><a href="{{ route('legal.privacy') }}" class="text-gray-400 hover:text-white transition duration-150">Privacy Policy</a></li>
                    <li><a href="{{ route('legal.accessibility') }}" class="text-gray-400 hover:text-white transition duration-150">Accessibility</a></li>
                </ul>
            </div>
            
            {{-- NEWSLETTER SECTION REMOVED --}}

        </div>

        <!-- Copyright -->
        <div class="mt-8 text-center text-gray-500 text-sm dark:text-gray-600">
            &copy; {{ date('Y') }} E-SHOP. All rights reserved.
        </div>
    </div>
</footer>