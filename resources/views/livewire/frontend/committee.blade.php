<div>
    <section class="flex justify-center mb-8 text-center">
        <!-- <h1 class="text-3xl sm:text-4xl font-extrabold text-white">
          Card Grid with Hover Details
        </h1>
        <p class="mt-2 text-gray-200">
          Responsive grid, Tailwind CSS — hover to reveal more info.
        </p> -->
        <div style="width: 315px;">
            <a href="{{ route('committee.details', 'sdg-bubt-committee') }}">
                <img src="{{ asset('assets/sdg-bubt-committee.png') }}" alt="SDG Wheel"
                    class="mt-14 mx-auto object-cover rounded-full border-4 border-white shadow-xl animate-spin-slow"
                    style="width: 300px; height: 300px;" />
            </a>
        </div>


    </section>
    <section class="relative py-12 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto rounded-3xl overflow-hidden bg-white/10 p-1" style="max-width: 80%;">
            @if (!$goals->isEmpty())
                <!-- Responsive grid: 1 col (mobile), 2 cols (tablet), 3 cols (desktop) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($goals as $goal)
                        <article
                            class="backdrop-blur-sm bg-white/5 group hover:-translate-y-1 hover:shadow-2xl overflow-hidden rounded-2xl shadow-lg transform transition relative">
                            <a href="{{ route('committee.details', $goal->slug) }}" class="absolute inset-0 z-10"></a>
                            <div class="flex h-full">
                                <!-- Left: image -->
                                <div class="w-2/5 h-full overflow-hidden rounded-l-2xl">
                                    <img src="{{ $goal->sdg_image ? asset('storage/' . $goal->sdg_image) : asset('assets/no-image.png') }}"
                                        alt="{{ $goal->title }}"
                                        class="w-full h-full object-cover object-center transition-transform duration-300 group-hover:scale-105" />
                                </div>

                                <!-- Right: content -->
                                <div class="w-3/5 bg-indigo-600 flex flex-col justify-between p-4 rounded-r-2xl">
                                    <div>
                                        <h3 class="text-lg font-semibold text-white">
                                            {{ $goal->title ? \Illuminate\Support\Str::limit($goal->title, 35, '...') : 'N/A' }}
                                        </h3>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-100" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-white">
                                                    {{ $goal->committee_members_count }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <a class="bg-white/10 hover:bg-indigo-700 px-3 py-1 rounded-full text-sm text-white transition"
                                            href="#">Details</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="grid md:grid-cols-1 xl:grid-cols-1 gap-6">
                    <div class="card flex h-80 justify-center p-8">
                        <div class="flex flex-col items-center justify-center h-64 text-gray-500">
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
    </section>

</div>
