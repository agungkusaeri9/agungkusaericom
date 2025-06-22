<nav
    class="bg-white/95 backdrop-blur-md shadow-lg border-b border-gray-100 sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        @php
                            $author = explode(' ', $setting->author);
                        @endphp
                        <span
                            class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">{{ \Str::ucfirst($author[0]) }}</span>
                        <span
                            class="text-sm font-medium text-gray-600 group-hover:text-purple-600 transition-colors duration-300">{{ \Str::ucfirst($author[1]) }}</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-8">
                    <a href="{{ route('home') }}"
                        class="relative px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors duration-300 @if (request()->is('/')) text-blue-600 @endif group">
                        <span class="relative z-10">Home</span>
                        @if (request()->is('/'))
                            <div
                                class="absolute inset-0 bg-blue-50 rounded-lg transform scale-110 transition-transform duration-300">
                            </div>
                        @else
                            <div
                                class="absolute inset-0 bg-gray-50 rounded-lg transform scale-0 group-hover:scale-110 transition-transform duration-300">
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('projects.index') }}"
                        class="relative px-3 py-2 text-sm font-medium text-gray-700 hover:text-purple-600 transition-colors duration-300 @if (request()->is('projects*')) text-purple-600 @endif group">
                        <span class="relative z-10">Projects</span>
                        @if (request()->is('projects*'))
                            <div
                                class="absolute inset-0 bg-purple-50 rounded-lg transform scale-110 transition-transform duration-300">
                            </div>
                        @else
                            <div
                                class="absolute inset-0 bg-gray-50 rounded-lg transform scale-0 group-hover:scale-110 transition-transform duration-300">
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('posts.index') }}"
                        class="relative px-3 py-2 text-sm font-medium text-gray-700 hover:text-green-600 transition-colors duration-300 @if (request()->is('blogs*')) text-green-600 @endif group">
                        <span class="relative z-10">Blog</span>
                        @if (request()->is('blogs*'))
                            <div
                                class="absolute inset-0 bg-green-50 rounded-lg transform scale-110 transition-transform duration-300">
                            </div>
                        @else
                            <div
                                class="absolute inset-0 bg-gray-50 rounded-lg transform scale-0 group-hover:scale-110 transition-transform duration-300">
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('about') }}"
                        class="relative px-3 py-2 text-sm font-medium text-gray-700 hover:text-orange-600 transition-colors duration-300 @if (request()->is('about*')) text-orange-600 @endif group">
                        <span class="relative z-10">About</span>
                        @if (request()->is('about*'))
                            <div
                                class="absolute inset-0 bg-orange-50 rounded-lg transform scale-110 transition-transform duration-300">
                            </div>
                        @else
                            <div
                                class="absolute inset-0 bg-gray-50 rounded-lg transform scale-0 group-hover:scale-110 transition-transform duration-300">
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('contact.index') }}"
                        class="relative px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg hover:from-blue-600 hover:to-purple-600 transition-all duration-300 transform hover:scale-105 hover:shadow-lg @if (request()->is('contact')) shadow-lg @endif">
                        Contact Me
                    </a>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button"
                    class="relative inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-all duration-300"
                    aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMobileMenu()">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg class="block h-6 w-6" id="menu-closed" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open -->
                    <svg class="hidden h-6 w-6" id="menu-open" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="hidden md:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white/95 backdrop-blur-md border-t border-gray-100">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 @if (request()->is('/')) text-blue-600 bg-blue-50 @endif">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Home
                </div>
            </a>

            <a href="{{ route('projects.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50 transition-all duration-300 @if (request()->is('projects*')) text-purple-600 bg-purple-50 @endif">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Projects
                </div>
            </a>

            <a href="{{ route('posts.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-green-50 transition-all duration-300 @if (request()->is('blogs*')) text-green-600 bg-green-50 @endif">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Blog
                </div>
            </a>

            <a href="{{ route('about') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition-all duration-300 @if (request()->is('about*')) text-orange-600 bg-orange-50 @endif">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    About
                </div>
            </a>

            <a href="{{ route('contact.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 transition-all duration-300 @if (request()->is('contact')) shadow-lg @endif">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Contact Me
                </div>
            </a>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        const menuClosed = document.getElementById('menu-closed');
        const menuOpen = document.getElementById('menu-open');

        if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
            mobileMenu.classList.add('animate-fadeIn');
            menuClosed.classList.add('hidden');
            menuOpen.classList.remove('hidden');
        } else {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('animate-fadeIn');
            menuClosed.classList.remove('hidden');
            menuOpen.classList.add('hidden');
        }
    }

    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('nav');
        if (window.scrollY > 50) {
            navbar.classList.add('shadow-xl', 'bg-white/98');
        } else {
            navbar.classList.remove('shadow-xl', 'bg-white/98');
        }
    });
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>
