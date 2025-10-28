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
        {{-- <div class="max-w-7xl mx-auto rounded-3xl overflow-hidden bg-white/10 p-1"> --}}
        <div class="mx-auto rounded-3xl overflow-hidden bg-white/10 p-1" style="max-width: 80%;">
            @if (!$goals->isEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($goals as $goal)
                        <article wire:key="item-{{ $goal->id }}"
                            class="group relative bg-white/10 backdrop-blur-sm rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border border-white/10">

                            <a href="{{ route('goal.details', $goal->slug) }}" class="absolute inset-0 z-10"></a>

                            <div class="flex flex-col h-full">
                                <!-- Image Section -->

                                <div class="relative h-64 group overflow-hidden rounded-t-3xl">
                                    <!-- Main Goal Image -->
                                    <img wire:loading.remove
                                        src="{{ $goal->images ? asset('storage/' . $goal->images) : asset('assets/no-image.png') }}"
                                        alt="Goal Image"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                    <!-- Hover Overlay -->
                                    <div
                                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col items-center justify-center text-white text-center p-4">

                                        <div class="flex flex-wrap gap-2 p-4 bg-indigo-700/20 border-t border-white/10">
                                            @foreach ($goal->achievement_counts as $label => $count)
                                                <span
                                                    class="text-white/80 text-lg bg-indigo-600/30 px-3 py-1 rounded-full">
                                                    {{ $label }}: {{ $count }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>


                                </div>

                                <!-- Content Section -->
                                <div class="bg-indigo-600 flex flex-col justify-between flex-grow p-6">
                                    <article class="group overflow-hidden rounded-2xl shadow-lg">
                                        <div class="flex flex-col md:flex-row h-full">
                                            <!-- Left: image -->
                                            @if ($goal->sdg_image)
                                                <div class="md:w-2/5 h-48 md:h-auto overflow-hidden"
                                                    style="height: 100%;">
                                                    <div wire:loading>
                                                        <svg fill="hsl(228, 97%, 42%)" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"
                                                                opacity=".25" />
                                                            <path
                                                                d="M12,4a8,8,0,0,1,7.89,6.7A1.53,1.53,0,0,0,21.38,12h0a1.5,1.5,0,0,0,1.48-1.75,11,11,0,0,0-21.72,0A1.5,1.5,0,0,0,2.62,12h0a1.53,1.53,0,0,0,1.49-1.3A8,8,0,0,1,12,4Z">
                                                                <animateTransform attributeName="transform"
                                                                    type="rotate" dur="0.75s"
                                                                    values="0 12 12;360 12 12"
                                                                    repeatCount="indefinite" />
                                                            </path>
                                                        </svg>
                                                    </div>

                                                    <img wire:loading.remove
                                                        src="{{ asset('storage/' . $goal->sdg_image) }}" alt="SDG Image"
                                                        class="w-full h-full object-contain">
                                                    />
                                                </div>
                                            @endif
                                            <!-- Content on right -->
                                            <div class="bg-indigo-600 flex flex-col justify-between flex-grow p-6">
                                                <div>
                                                    <h1 class="font-semibold text-white" style="font-size: x-large;">
                                                        {{ $goal->title ? \Illuminate\Support\Str::limit($goal->title, 50, '...') : 'N/A' }}
                                                    </h1>
                                                    <p class="mt-2 text-sm text-gray-200 line-clamp-3">
                                                        {{ $goal->short_description ? \Illuminate\Support\Str::limit($goal->short_description, 100, '...') : 'N/A' }}
                                                    </p>
                                                </div>

                                                <div class="mt-4 flex items-center justify-between">
                                                    <a href="{{ route('goal.details', $goal->slug) }}"
                                                        class="bg-white/10 hover:bg-indigo-700 px-3 py-1 rounded-full text-sm text-white transition">
                                                        More Details
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </article>
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
{{-- 
    <section class="relative py-12 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto rounded-3xl overflow-hidden bg-white/10 p-1" style="max-width: 80%;">
            @if (!$goals->isEmpty())
                <!-- Grid: 3 columns on md+ screens -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($goals as $goal)
                        <article wire:key="item-{{ $goal->id }}"
                            class="group relative bg-white/10 backdrop-blur-sm rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border border-white/10 flex flex-col">

                            <!-- Clickable link -->
                            <a href="{{ route('goal.details', $goal->slug) }}" class="absolute inset-0 z-10"></a>

                            <!-- Image Section -->
                            <div class="relative h-[150px] overflow-hidden rounded-t-3xl">
                                <img wire:loading.remove
                                    src="{{ $goal->images ? asset('storage/' . $goal->images) : asset('assets/no-image.png') }}"
                                    alt="Goal Image"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                <!-- Hover Overlay -->
                                <div
                                    class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col items-center justify-center text-white text-center p-4">
                                    <div
                                        class="flex flex-wrap gap-2 p-2 bg-indigo-700/20 border-t border-white/10 rounded">
                                        @foreach ($goal->achievement_counts as $label => $count)
                                            <span
                                                class="text-white/80 text-sm md:text-base bg-indigo-600/30 px-2 py-1 rounded-full">
                                                {{ $label }}: {{ $count }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="bg-indigo-600 flex flex-col justify-between flex-grow p-4">
                                <div class="flex items-start gap-3">
                                    @if ($goal->sdg_image)
                                        <div class="flex-shrink-0 w-16 h-16 overflow-hidden rounded-xl">
                                            <img wire:loading.remove src="{{ asset('storage/' . $goal->sdg_image) }}"
                                                alt="SDG Image" class="w-full h-full object-contain">
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-semibold text-white text-lg md:text-xl">
                                            {{ $goal->title ? \Illuminate\Support\Str::limit($goal->title, 50, '...') : 'N/A' }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-200 line-clamp-3">
                                            {{ $goal->short_description ? \Illuminate\Support\Str::limit($goal->short_description, 100, '...') : 'N/A' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('goal.details', $goal->slug) }}"
                                        class="bg-white/10 hover:bg-indigo-700 px-3 py-1 rounded-full text-sm text-white transition">
                                        More Details
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($goals->total() > $goals->perPage())
                    <div class="flex justify-between items-center mt-6">
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
                                    class="px-3 py-1 rounded {{ $page == $goals->currentPage() ? 'bg-slate-700 text-white' : 'bg-gray-200 text-gray-700' }}">
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
                <!-- No data -->
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex h-80 justify-center p-8 bg-white/10 rounded-3xl">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-3 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-lg font-medium">{{ __('Data not found') }}!</p>
                            <p class="text-sm text-gray-400">{{ __('Try creating a new goal.') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section> --}}

</div>
