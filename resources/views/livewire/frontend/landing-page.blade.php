<div>
    <section class="mb-8 text-center">
        <!-- <h1 class="text-3xl sm:text-4xl font-extrabold text-white">
          Card Grid with Hover Details
        </h1>
        <p class="mt-2 text-gray-200">
          Responsive grid, Tailwind CSS — hover to reveal more info.
        </p> -->
    </section>
    <section class="relative py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto rounded-3xl overflow-hidden bg-white/10 p-1">
            @if (!$goals->isEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($goals as $goal)
                        <article wire:key="item-{{ $goal->id }}"
                            class="group relative bg-white/10 backdrop-blur-sm rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border border-white/10">
                            <div class="flex flex-col h-full">
                                <!-- Image Section -->
                                <div class="relative h-64">
                                    <!-- Main Goal Image -->
                                    <img src="{{ $goal->images ? asset('storage/' . $goal->images) : asset('assets/no-image.png') }}"
                                        alt="Goal Image" class="w-full h-full object-cover">

                                    <!-- SDG Image with Gradient Overlay -->
                                    @if ($goal->sdg_image)
                                        <div class="absolute top-3 left-3 rounded-lg overflow-hidden shadow-md"
                                            style="width: 150px; height: 150px;">
                                            <!-- SDG Image -->
                                            <img src="{{ asset('storage/' . $goal->sdg_image) }}" alt="SDG Image"
                                                class="w-full h-full object-contain">

                                            <!-- Gradient Overlay ON SDG Image -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-r from-blue-600/70 via-indigo-600/70 to-purple-600/70 opacity-60 group-hover:opacity-80 transition-all duration-300">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content Section -->
                                <div class="bg-indigo-600 flex flex-col justify-between flex-grow p-6">
                                    <div>
                                        <h3 class="text-lg font-semibold text-white">
                                            {{ $goal->title ? \Illuminate\Support\Str::limit($goal->title, 50, '...') : 'N/A' }}
                                        </h3>
                                        <p class="mt-2 text-sm text-gray-200 line-clamp-3">
                                            {{ $goal->short_description ? \Illuminate\Support\Str::limit($goal->short_description, 100, '...') : 'N/A' }}
                                        </p>
                                    </div>

                                    <div class="mt-4 flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-100" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-white">
                                                    {{ $goal->creator?->name ?? 'N/A' }}</p>
                                                <p class="text-xs text-gray-300">
                                                    {{ $goal->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('goal.details', $goal->slug) }}"
                                            class="bg-white/10 hover:bg-indigo-700 px-3 py-1 rounded-full text-sm text-white transition">
                                            More Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>
                <!-- Custom Pagination -->
                @if (!count($goals) > 20)
                    <div class="flex justify-between items-center mt-4" style="margin-top: 100px;">
                        <div>
                            Showing {{ $goals->firstItem() }} to {{ $goals->lastItem() }} of
                            {{ $goals->total() }} results
                        </div>

                        <div class="flex space-x-1">
                            @if ($goals->onFirstPage())
                                <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Previous</span>
                            @else
                                <button wire:click="previousPage"
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Previous</button>
                            @endif

                            @foreach ($goals->getUrlRange(1, $goals->lastPage()) as $page => $url)
                                <button wire:click="gotoPage({{ $page }})"
                                    class="px-3 py-1 rounded {{ $page == $goals->currentPage() ? 'bg-slate-700 px-3 py-1 rounded text-white' : 'bg-gray-200 text-gray-700' }}">
                                    {{ $page }}
                                </button>
                            @endforeach

                            @if ($goals->hasMorePages())
                                <button wire:click="nextPage"
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next</button>
                            @else
                                <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Next</span>
                            @endif
                        </div>
                    </div>
                @endif
            @else
                <div class="grid md:grid-cols-1 xl:grid-cols-1 gap-6">
                    <div class="card flex h-80 justify-center p-8">
                        <div class="flex flex-col items-center justify-center h-64 text-gray-500">
                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-3 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <!-- Text -->
                            <p class="text-lg font-medium">{{ __('Data not found') }}!</p>
                            <p class="text-sm text-gray-400">{{ __('Try creating a new goal.') }}</p>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
