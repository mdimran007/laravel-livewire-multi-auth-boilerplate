<div>

    <!-- Hero Section -->
    <div class="relative h-96">
        @if (!$isMainCommittee)
            <img class="w-full h-full object-cover"
                src="{{ $goalDetails->images != null ? asset('storage/' . $goalDetails->images) : asset('assets/no-image.png') }}"
                alt="Goal Hero Image">
        @endif

        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/90 via-indigo-600/90 to-purple-600/90"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="mx-auto px-4 sm:px-6 lg:px-8 w-full" style="max-width: 80%;">
                @if (!$isMainCommittee)
                    <h1 class="text-4xl font-bold text-white mb-4">{{ $goalDetails->title ?? 'N/A' }}</h1>
                    <p class="text-xl text-white/90">{{ $goalDetails->short_description ?? 'N/A' }}</p>
                @else
                    <h1 class="text-4xl font-bold text-white mb-4">{{ $mainCommitteeTitle ?? 'N/A' }}</h1>
                    <p class="text-xl text-white/90">{{ $mainCommitteeShortDesc ?? 'N/A' }}</p>
                @endif
            </div>
        </div>
    </div>


    <!-- Main Content -->
    <main class="flex-1 py-12">
        <div
            class="mx-auto px-4 sm:px-6 lg:px-8 text-white prose prose-invert prose-a:text-blue-400 hover:prose-a:text-blue-500" style="max-width: 80%;">

            <section class="py-12 px-4 sm:px-6 lg:px-8">
                <div class="mx-auto" >
                    <h3 class="text-4xl mb-16 text-black">Member List:</h3>

                    {{-- If not main committee --}}
                    @if (!$isMainCommittee)
                        @if ($goalDetails->committeeMembers != null && $goalDetails->committeeMembers->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($goalDetails->committeeMembers as $member)
                                    <div
                                        class="backdrop-blur-md bg-white/10 border border-t hover:-translate-y-1 hover:shadow-2xl overflow-hidden rounded-2xl shadow-lg transform transition flex flex-col">
                                        <!-- Member Image -->
                                        <div class="relative h-56 bg-gray-100">
                                            <img src="{{ $member->picture ? asset('storage/' . $member->picture) : asset('assets/no-image.png') }}"
                                                alt="{{ $member->name }}"
                                                class="w-full h-full object-cover object-center transition-transform duration-500 hover:scale-105">
                                        </div>

                                        <!-- Member Info -->
                                        <div
                                            class="bg-indigo-600 border flex-1 flex-col justify-between p-5 text-center">
                                            <div>
                                                <h3 class="text-lg font-semibold text-white">
                                                    {{ $member->name ?? 'N/A' }}
                                                </h3>
                                                <p class="mb-4 mt-1 text-gray-200 text-sm">
                                                    {{ $member->designation ?? 'No designation' }}
                                                </p>
                                            </div>

                                            @if ($member->url)
                                                <a href="{{ $member->url }}" target="_blank"
                                                    class="bg-white/10 hover:bg-indigo-700 px-3 py-1 rounded-full text-white transition w-1/2">
                                                    View Profile
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center h-64 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-lg font-medium">No committee members found!</p>
                            </div>
                        @endif
                    @else
                        {{-- For main committee --}}
                        @if ($committeeMembers != null && $committeeMembers->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($committeeMembers as $member)
                                    <div
                                        class="backdrop-blur-md bg-white/10 border border-t hover:-translate-y-1 hover:shadow-2xl overflow-hidden rounded-2xl shadow-lg transform transition flex flex-col">
                                        <!-- Member Image -->
                                        <div class="relative h-56 bg-gray-100">
                                            <img src="{{ $member->picture ? asset('storage/' . $member->picture) : asset('assets/no-image.png') }}"
                                                alt="{{ $member->name }}"
                                                class="w-full h-full object-cover object-center transition-transform duration-500 hover:scale-105">
                                        </div>

                                        <!-- Member Info -->
                                        <div
                                            class="bg-indigo-600 border flex-1 flex-col justify-between p-5 text-center">
                                            <div>
                                                <h3 class="text-lg font-semibold text-white">
                                                    {{ $member->name ?? 'N/A' }}
                                                </h3>
                                                <p class="mb-4 mt-1 text-gray-200 text-sm">
                                                    {{ $member->designation ?? 'No designation' }}
                                                </p>
                                            </div>

                                            @if ($member->url)
                                                <a href="{{ $member->url }}" target="_blank"
                                                    class="bg-white/10 hover:bg-indigo-700 px-3 py-1 rounded-full text-white transition w-1/2">
                                                    View Profile
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center h-64 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-lg font-medium">No committee members found!</p>
                            </div>
                        @endif
                    @endif
                </div>
            </section>
        </div>
    </main>

</div>
