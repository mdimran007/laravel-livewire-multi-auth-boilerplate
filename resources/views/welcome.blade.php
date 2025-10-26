<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Card Grid — Tailwind</title>

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
</head>

<body class="min-h-screen flex flex-col from-indigo-600 via-purple-600 to-pink-500">
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
                            <img src="data:image/png;base64,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"
                                alt="Left Logo" class="h-8 w-auto" />
                        </div>
                    </div>

                    <!-- Center nav -->
                    <div class="flex-1 flex justify-center">
                        <nav class="hidden md:flex md:items-center md:space-x-8">
                            <a href="#"
                                class="px-3 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition">Home</a>
                            <a href="#"
                                class="px-3 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition">About</a>
                            <a href="#"
                                class="px-3 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition">Services</a>
                            <a href="#"
                                class="px-3 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition">Contact</a>
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
                        <div class="p-1.5 bg-white/10 rounded-lg hover:bg-white/20 transition">
                            <img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400/ed535353880001.594443e25ce53.png"
                                alt="Right Logo" class="h-8 w-auto" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="md:hidden hidden">
                <div class="px-4 py-3 space-y-1 bg-gradient-to-b from-transparent to-black/20 border-t border-white/10">
                    <a href="#"
                        class="block px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-white/10 transition">Home</a>
                    <a href="#"
                        class="block px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-white/10 transition">About</a>
                    <a href="#"
                        class="block px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-white/10 transition">Services</a>
                    <a href="#"
                        class="block px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-white/10 transition">Contact</a>
                </div>
            </div>
        </div>
    </header>
    <!-- MAIN / CONTAINER -->
    <!-- Replace the existing main section -->
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <section class="mb-8 text-center">
            <!-- <h1 class="text-3xl sm:text-4xl font-extrabold text-white">
          Card Grid with Hover Details
        </h1>
        <p class="mt-2 text-gray-200">
          Responsive grid, Tailwind CSS — hover to reveal more info.
        </p> -->
        </section>

        <!-- Card section with gradient background -->
        <section class="relative py-12 px-4 sm:px-6 lg:px-8">
            <!-- Group wrapper shows separators between cards -->
            <div class="max-w-7xl mx-auto rounded-3xl overflow-hidden bg-white/10 p-1">
                <!-- Change to grid-cols-1 for mobile and grid-cols-2 for larger screens -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- First Card -->
                    <article
                        class="backdrop-blur-sm bg-white/5 group hover:-translate-y-1 hover:shadow-2xl overflow-hidden rounded-2xl shadow-lg transform transition">
                        <div class="flex flex-col h-full">
                            <!-- Left: image -->
                            <div class="h-48 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1600&auto=format&fit=crop"
                                    alt="Card image" class="w-full h-full object-cover" />
                            </div>
                            <!-- Content -->
                            <div class="bg-indigo-600 flex flex-col justify-between flex-grow p-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Horizontal Card Title</h3>
                                    <p class="mt-2 text-sm text-gray-200 line-clamp-3">
                                        Short description about this card. On small screens the image stacks above the
                                        content.
                                    </p>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-100" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-white">Author Name</p>
                                            <p class="text-xs text-gray-300">3h ago</p>
                                        </div>
                                    </div>
                                    <a class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-full transition"
                                        href="#">Action</a>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Second Card -->
                    <article
                        class="backdrop-blur-sm bg-white/5 group hover:-translate-y-1 hover:shadow-2xl overflow-hidden rounded-2xl shadow-lg transform transition">
                        <div class="flex flex-col h-full">
                            <!-- Left: image -->
                            <div class="h-48 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=1600&auto=format&fit=crop"
                                    alt="Card image" class="w-full h-full object-cover" />
                            </div>
                            <!-- Content -->
                            <div class="bg-indigo-600 flex flex-col justify-between flex-grow p-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Second Card Title</h3>
                                    <p class="mt-2 text-sm text-gray-200 line-clamp-3">
                                        Another card description. These cards will appear side by side on larger
                                        screens.
                                    </p>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-100" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-white">Second Author</p>
                                            <p class="text-xs text-gray-300">5h ago</p>
                                        </div>
                                    </div>
                                    <a class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-full transition"
                                        href="#">View</a>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Add more card pairs as needed -->

                </div>
            </div>
        </section>
    </main>

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
                        © <span id="year"></span> Your Company. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>

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
