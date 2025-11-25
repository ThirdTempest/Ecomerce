<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'E-commerce Template')</title>

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN - USED FOR DEVELOPMENT/DEMO ONLY -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // NOTE: For Production, remove the CDN above and compile Tailwind using PostCSS or CLI.
        tailwind.config = {
            // CRITICAL: Enable dark mode based on parent class
            darkMode: 'class', 
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#057A55', // A nice green for e-commerce primary color
                        'secondary': '#F9F9F9',
                    }
                }
            }
        }
    </script>

    @yield('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-200 antialiased">
    
    <!-- Dark Mode Initializer Script -->
    <script>
        // Check local storage for theme preference and apply it instantly
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Header Component -->
    @include('components.header')

    <!-- Main Content Section -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer Component -->
    @include('components.footer')

    @stack('scripts')
</body>
</html>