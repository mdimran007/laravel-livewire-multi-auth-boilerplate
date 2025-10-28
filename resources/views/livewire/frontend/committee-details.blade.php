<div>

    <!-- Hero Section -->
    <div class="relative h-96">
        <img class="w-full h-full object-cover"
            src="{{ $goalDetails->images != null ? asset('storage/' . $goalDetails->images) : asset('assets/no-image.png') }}"
            alt="Goal Hero Image">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/90 via-indigo-600/90 to-purple-600/90"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <h1 class="text-4xl font-bold text-white mb-4">{{ $goalDetails->title ?? 'N/A' }}</h1>
                <p class="text-xl text-white/90">{{ $goalDetails->short_description ?? 'N/A' }}</p>
            </div>
        </div>
    </div>


    <!-- Main Content -->
    <main class="flex-1 py-12">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white prose prose-invert prose-a:text-blue-400 hover:prose-a:text-blue-500">

            <section class="py-12 px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    <h3 class="text-4xl" style="color: black;margin-bottom: 69px;">Member List:</h3>

                    @if ($goalDetails->committeeMembers != null && $goalDetails->committeeMembers->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($goalDetails->committeeMembers as $member)
                                <div
                                    class="backdrop-blur-md bg-white/10 border border-t hover:-translate-y-1 hover:shadow-2xl overflow-hidden rounded-2xl shadow-lg transform transition">
                                    <!-- Member Image -->
                                    <div class="relative h-56 bg-gray-100">
                                        <img src="{{ $member->picture ? asset('storage/' . $member->picture) : asset('assets/no-image.png') }}"
                                            alt="{{ $member->name }}"
                                            class="w-full h-full object-cover object-center transition-transform duration-500 hover:scale-105">
                                    </div>

                                    <!-- Member Info -->
                                    <div class="border p-5 text-center" style="background: rgb(51 64 223);">
                                        <h3 class="text-lg font-semibold text-white">
                                            {{ $member->name ?? 'N/A' }}
                                        </h3>
                                        <p class="text-sm text-gray-300 mt-1">
                                            {{ $member->designation ?? 'No designation' }}
                                        </p>

                                        @if ($member->url)
                                            <a href="{{ $member->url }}" target="_blank"
                                                class="inline-block mt-3 text-indigo-400 hover:text-indigo-300 text-sm underline">
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
                </div>
            </section>


        </div>
    </main>
</div>
