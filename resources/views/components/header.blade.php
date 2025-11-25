<header class="bg-white dark:bg-gray-900 shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl font-extrabold text-primary tracking-tight rounded-lg p-1">
                E-SHOP
            </a>

            <!-- Navigation Links (Hidden on Mobile) -->
            <nav class="hidden md:flex space-x-8">
                {{-- ADMIN PANEL LINK (Visible only to admins) --}}
                @auth
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-red-600 dark:text-red-400 hover:text-red-800 font-bold transition duration-150 ease-in-out border-b-2 border-red-600">Admin Panel</a>
                    @endif
                @endauth
                <a href="{{ route('shop') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition duration-150 ease-in-out font-bold">Shop All</a>
                
                <!-- CATEGORY BUTTONS -->
                <a href="{{ route('shop') }}?category={{ urlencode("Man's Clothing") }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition duration-150 ease-in-out">Men</a>
                <a href="{{ route('shop') }}?category={{ urlencode("Women's Clothing") }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition duration-150 ease-in-out">Women</a>
                <a href="{{ route('shop') }}?category={{ urlencode("Children's Clothing") }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition duration-150 ease-in-out">Kids</a>
                
                <a href="{{ route('new.arrivals') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition duration-150 ease-in-out">New Arrivals</a>
                <a href="{{ route('sale') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition duration-150 ease-in-out">Sale</a>
                <a href="{{ route('contact') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition duration-150 ease-in-out">Contact</a>
            </nav>

            <!-- Search and Icons -->
            <div class="flex items-center space-x-4">
                
                <!-- Search Bar (Form) -->
                <form action="{{ route('shop') }}" method="GET" class="relative hidden lg:block">
                    <input type="text" name="query" placeholder="Search products..." class="py-2 pl-10 pr-4 border border-gray-200 dark:border-gray-700 dark:bg-gray-800 rounded-lg focus:ring-primary focus:border-primary transition duration-150 ease-in-out w-64" value="{{ request('query') }}">
                    <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400 p-0 m-0">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
                
                <!-- Dark Mode Toggle Button (NEW) -->
                <button id="theme-toggle" title="Toggle Dark Mode" class="text-gray-600 dark:text-gray-300 hover:text-primary p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-150 ease-in-out">
                    <!-- Sun Icon (Default/Light Mode) -->
                    <svg id="theme-toggle-light-icon" class="w-6 h-6 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <!-- Moon Icon (Dark Mode) -->
                    <svg id="theme-toggle-dark-icon" class="w-6 h-6 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>
                
                <!-- User Profile/Login Icon (Conditional Link) -->
                @auth
                    <!-- Logged In: Link to Profile Page -->
                    <a href="{{ route('profile') }}" title="My Profile" class="text-gray-600 dark:text-gray-300 hover:text-primary p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </a>
                @else
                    <!-- Not Logged In: Link to Login Page -->
                    <a href="{{ route('login') }}" title="Sign In" class="text-gray-600 dark:text-gray-300 hover:text-primary p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </a>
                @endauth

                <!-- Cart Icon (UPDATED: Now a link to cart.view) -->
                <a href="{{ route('cart.view') }}" title="View Cart" class="relative text-gray-600 dark:text-gray-300 hover:text-primary p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    {{-- Note: Displaying cart count would require fetching session data in the view --}}
                </a>
                
                <!-- Logout Button (Only visible when logged in) -->
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" title="Log Out" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-red-500 py-2 px-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-150 ease-in-out hidden sm:block">
                            Logout
                        </button>
                    </form>
                @endauth

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-600 dark:text-gray-300 hover:text-primary p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById('theme-toggle').addEventListener('click', function() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    });
</script>