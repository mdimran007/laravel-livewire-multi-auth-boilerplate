<div>

    <!-- Hero Section -->
    <div class="relative h-96">
        <img class="w-full h-full object-cover"
            src="{{ $goal->images != null ? asset('storage/' . $goal->images) : asset('assets/no-image.png') }}"
            alt="Goal Hero Image">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/90 via-indigo-600/90 to-purple-600/90"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <h1 class="text-4xl font-bold text-white mb-4">{{ $goal->title ?? 'N/A' }}</h1>
                <p class="text-xl text-white/90">{{ $goal->short_description ?? 'N/A' }}</p>
            </div>
        </div>
    </div>


    <!-- Quick Navigation -->
    <nav class="sticky top-16 z-40 bg-gray-900/80 backdrop-blur-sm py-4 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center space-x-4 overflow-x-auto pb-4 scrollbar-hidden">
                <div class="flex items-center space-x-4 overflow-x-auto pb-4 scrollbar-hidden">
                    @foreach ($data as $key => $items)
                        @if ($items->count() > 0)
                            <a href="#{{ $key }}"
                                class="px-4 py-2 bg-white/10 rounded-full text-sm text-white hover:bg-white/20 transition whitespace-nowrap capitalize">
                                {{ str_replace('_', ' ', $key) }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @foreach ($data as $key => $items)
                @if ($items->count() > 0)
                    <section id="{{ $key }}" class="mb-16 scroll-mt-20">
                        <h2 class="text-2xl font-bold text-white mb-8 flex items-center">
                            <!-- You can use conditional icons per key if you like -->
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            {{ Str::title(str_replace('_', ' ', $key)) }}
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($items as $item)
                                <a href="{{ route('goal.asset.details', [$key, $item->slug]) }}">
                                    <article
                                        class="group relative bg-white/10 backdrop-blur-sm rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border border-white/10">
                                        <div class="relative h-64">
                                            <img class="w-full h-full object-cover"
                                                src="{{ $item->images != null ? asset('storage/' . $item->images) : asset('assets/no-image.png') }}"
                                                alt="{{ $item->title }}">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-r from-blue-600/90 via-indigo-600/90 to-purple-600/90">
                                            </div>
                                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                                <h3 class="text-xl font-bold text-white mb-2">
                                                    {{ $item->title != null ? \Illuminate\Support\Str::limit($item->title, 35, '...') : 'N/A' }}
                                                </h3>
                                                <p class="text-gray-200 text-sm leading-relaxed line-clamp-2">
                                                    {{ $item->short_description != null ? \Illuminate\Support\Str::limit($item->short_description, 100, '...') : 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </article>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $items->links() }}
                        </div>
                    </section>
                @endif
            @endforeach

        </div>
    </main>
</div>
