<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Home' }}</title>

    <!-- Tailwind CDN for quick prototyping -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- optional small Tailwind config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: "#374151"
                    },
                },
            },
        };
    </script>
    <style>
        .scrollbar-hidden::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hidden {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    @livewireStyles

</head>

<body
    class="{{ request()->routeIs('frontend.index') ? 'min-h-screen flex flex-col from-indigo-600 via-purple-600 to-pink-500' : 'min-h-screen flex flex-col ' }}">
    <!-- HEADER -->
    <!-- Replace the existing header section -->
    <header class="sticky top-0 z-50">
        <!-- Gradient background with shadow -->
        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Left logo -->
                    <div class="flex-shrink-0">
                        <div class="p-1.5 bg-white/10 rounded-lg hover:bg-white/20 transition">
                            <a href="{{ route('frontend.index') }}">
                                <img src="{{ getSettingData('app_logo') != null ? asset('storage/' . getSettingData('app_logo')) : asset('assets/no-image.png') }}"
                                    alt="App Logo" class="h-8 w-auto" />
                            </a>
                        </div>
                    </div>

                    <!-- Center nav -->
                    <div class="flex-1 flex justify-center">
                        <nav class="hidden md:flex md:items-center md:space-x-8">
                            <a href="{{ route('frontend.index') }}"
                                class="px-3 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition {{ setActive('frontend.index') }}">{{ __('Sustainability') }}</a>
                            <a href="#"
                                class="px-3 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition">
                                {{ __('SDGs Report') }} </a>
                            <a href="#"
                                class="px-3 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition">
                                {{ __('Committee') }} </a>
                        </nav>
                    </div>

                    <!-- Right section with logo and mobile menu -->
                    <div class="flex items-center space-x-4">
                        <!-- Mobile menu button -->
                        <div class="md:hidden">
                            <button id="menu-btn" aria-expanded="false" aria-controls="mobile-menu"
                                class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/10 focus:outline-none transition">
                                <svg id="icon-open" class="h-6 w-6" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <svg id="icon-close" class="h-6 w-6 hidden" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <!-- Right logo -->
                        <a href="https://www.bubt.edu.bd/">
                            <div class="p-1.5 bg-white/10 rounded-lg hover:bg-white/20 transition">
                                <img src="{{ getSettingData('institute_logo') != null ? asset('storage/' . getSettingData('institute_logo')) : asset('assets/no-image.png') }}"
                                    alt="Right Logo" class="h-8 w-auto" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="md:hidden hidden">
                <div class="px-4 py-3 space-y-1 bg-gradient-to-b from-transparent to-black/20 border-t border-white/10">
                    <a href="{{ route('frontend.index') }}"
                        class="px-3 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition {{ setActive('frontend.index') }}">{{ __('Sustainability') }}</a>
                    <a href="#"
                        class="px-3 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition">
                        {{ __('SDGs Report') }} </a>
                    <a href="#"
                        class="px-3 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition">
                        {{ __('Committee') }} </a>
                </div>
            </div>
        </div>
    </header>
    <!-- MAIN / CONTAINER -->
    <!-- Replace the existing main section -->

    <div wire:loading>
        <div class="space-y-4 animate-pulse">
            <div class="h-6 bg-gray-700 rounded w-1/3"></div>
            <div class="h-4 bg-gray-700 rounded w-2/3"></div>
            <div class="h-4 bg-gray-700 rounded w-1/2"></div>
        </div>
    </div>
    <div wire:loading.remove>
        {{ $slot }}
    </div>


    <!-- FOOTER -->
    <!-- Replace the existing footer -->
    <!-- Replace the existing footer -->
    <footer class="mt-auto">
        <!-- Add gradient background wrapper -->
        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Footer content -->
                <div class="flex flex-col items-center space-y-4">
                    <!-- Copyright -->
                    <div class="text-gray-200 text-sm">
                        © <span id="year"></span>
                        {{ getSettingData('app_name') != null ? getSettingData('app_name') : 'BUBT' }}. All rights
                        reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
    @stack('script')

    <!-- Small JS: mobile menu toggle + year -->
    <script>
        (function() {
            const btn = document.getElementById("menu-btn");
            const menu = document.getElementById("mobile-menu");
            const iconOpen = document.getElementById("icon-open");
            const iconClose = document.getElementById("icon-close");

            btn &&
                btn.addEventListener("click", () => {
                    const open = menu.classList.toggle("hidden");
                    // toggle svg icons (open/close)
                    iconOpen.classList.toggle("hidden");
                    iconClose.classList.toggle("hidden");
                    btn.setAttribute(
                        "aria-expanded",
                        !menu.classList.contains("hidden")
                    );
                });

            // set current year
            document.getElementById("year").textContent = new Date().getFullYear();
        })();
    </script>
</body>

</html>
