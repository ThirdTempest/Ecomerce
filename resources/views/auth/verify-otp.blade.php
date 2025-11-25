<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Account</title>

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', 
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#057A55', // A nice green for e-commerce primary color
                    }
                }
            }
        }
    </script>
    <!-- Dark Mode Initializer Script -->
    <script>
        // Check local storage for theme preference and apply it instantly
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased min-h-screen flex items-center justify-center relative transition-colors duration-300">
    
    <!-- Dark Mode Toggle (Top Right Corner) - ENHANCED VISIBILITY -->
    <div class="absolute top-6 right-6">
        <button id="theme-toggle" title="Toggle Dark Mode" 
            class="flex items-center justify-center w-12 h-12 text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-primary/50 rounded-full border-2 border-gray-300 dark:border-gray-600 shadow-lg transition-all duration-200 ease-in-out transform hover:scale-110">
            
            <!-- Sun Icon (Default/Light Mode) -->
            <svg id="theme-toggle-light-icon" class="w-6 h-6 hidden dark:block text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            
            <!-- Moon Icon (Dark Mode) -->
            <svg id="theme-toggle-dark-icon" class="w-6 h-6 block dark:hidden text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
        </button>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 flex justify-center items-center">
        <!-- Main Card with Dark Mode Styles -->
        <div class="w-full max-w-md bg-white dark:bg-gray-800 p-8 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700 text-center transition-colors duration-300">
            <a href="{{ route('home') }}" class="text-3xl font-extrabold text-primary tracking-tight text-center block mb-6">
                E-SHOP
            </a>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                Verify Your Email
            </h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                We've sent a 6-digit code to <br> 
                <strong class="text-primary">{{ session('email') }}</strong>
            </p>

            <!-- OTP Form -->
            <form action="{{ route('otp.check') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">

                @if ($errors->any())
                    <div class="bg-red-100 dark:bg-red-900/50 border border-red-400 dark:border-red-500 text-red-700 dark:text-red-300 px-4 py-3 rounded relative text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label for="otp" class="sr-only">OTP Code</label>
                    <input id="otp" name="otp" type="text" required
                        class="w-full text-center text-2xl tracking-widest px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition duration-150"
                        placeholder="123456" maxlength="6"
                    >
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-lg font-medium text-white bg-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-150"
                >
                    Verify Code