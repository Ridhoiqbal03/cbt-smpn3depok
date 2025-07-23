<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMPN 3 CBT System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Custom Styles -->
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            }
            .hero-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            <nav class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col lg:flex-row lg:justify-between h-auto lg:h-16">
                        <!-- Logo Section - Centered on full screen, left on mobile -->
                        <div class="flex items-center justify-center lg:justify-start py-4 lg:py-0">
                            <div class="flex-shrink-0 flex items-center">
                                <img class="h-12 w-auto" src="{{asset('images/logo/uptd.png')}}">
                                <span class="ml-2 text-xl font-semibold text-gray-900">UPTD SMPN 3 DEPOK</span>
                                <img class="h-12 w-auto" src="{{asset('images/logo/smpn3.png')}}">
                            </div>
                        </div>
                        
                        <!-- Auth Buttons - Centered on full screen, left on mobile -->
                        <div class="flex items-center justify-center lg:justify-end pb-4 lg:pb-0">
                        @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                        @endif
                        </div>
                                </div>
                                        </div>
            </nav>

            <!-- Hero Section -->
            <div class="gradient-bg hero-pattern">
                <div class="max-w-7xl mx-auto py-12 lg:py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                            <span class="block text-indigo-200">Welcome to SMPN 3</span>
                            <span class="block text-indigo-200">Computer-Based Test System</span>
                        </h1>
                        <p class="mt-4 lg:mt-6 max-w-2xl mx-auto text-lg lg:text-xl text-indigo-200">
                            Terciptanya Insan Unggul, Berdasarkan Imtaq, Berkarakter Literat, dan Berwawasan Lingkungan Global.
                                            </p>
                                        </div>
                                    </div>
                                </div>

            <!-- Features Section -->
            <div class="py-12 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="relative p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mb-4">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">Online Examinations</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Conduct secure and reliable online tests with our advanced examination system.
                                    </p>
                                </div>

                        <!-- Feature 2 -->
                        <div class="relative p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mb-4">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                </div>
                            <h3 class="text-lg font-medium text-gray-900">Instant Results</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Get immediate feedback and results after completing your examinations.
                                    </p>
                                </div>

                        <!-- Feature 3 -->
                        <div class="relative p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mb-4">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                    </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">Easy to Use</h3>
                            <p class="mt-2 text-base text-gray-500">
                                User-friendly interface designed for both students and teachers.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-gray-50 border-t border-gray-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm text-gray-500">
                        &copy; {{ date('Y') }} SMPN 3 CBT System. All rights reserved.
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html>
