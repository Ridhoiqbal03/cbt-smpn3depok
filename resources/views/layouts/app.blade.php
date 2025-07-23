<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Success Message -->
            @if(session('success'))
                <!-- Modal Overlay -->
                <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center modal-enter" id="success-modal">
                    <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4 transform transition-all shadow-2xl">
                        <div class="text-center">
                            <!-- Success Icon -->
                            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4 animate-bounce">
                                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            
                            <!-- Success Title -->
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Berhasil!</h3>
                            
                            <!-- Success Message -->
                            <p class="text-sm text-gray-500 mb-6">{{ session('success') }}</p>
                            
                            <!-- OK Button -->
                            <button onclick="closeSuccessModal()" class="w-full btn-success">
                                OK
                            </button>
                        </div>
                    </div>
                </div>
                
                <script>
                    function closeSuccessModal() {
                        const modal = document.getElementById('success-modal');
                        modal.classList.remove('modal-enter');
                        modal.classList.add('modal-exit');
                        
                        setTimeout(() => {
                            modal.style.display = 'none';
                        }, 300);
                    }
                    
                    // Prevent closing by clicking outside for better UX
                    document.getElementById('success-modal').addEventListener('click', function(e) {
                        if (e.target === this) {
                            closeSuccessModal();
                        }
                    });
                </script>
            @endif

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
