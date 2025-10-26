<div>

    <!-- Hero Section -->
    <div class="relative h-96">
        <img class="w-full h-full object-cover"
            src="{{ $goalAssetDetails->images != null ? asset('storage/' . $goalAssetDetails->images) : asset('assets/no-image.png') }}"
            alt="Goal Hero Image">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/90 via-indigo-600/90 to-purple-600/90"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <h1 class="text-4xl font-bold text-white mb-4">{{ $goalAssetDetails->title ?? 'N/A' }}</h1>
                <p class="text-xl text-white/90">{{ $goalAssetDetails->short_description ?? 'N/A' }}</p>

                 @if (isset($goalAssetDetails->event_date) && $goalAssetDetails->event_date != null)
                    <p class="mt-2 text-sm text-white/80">
                        <strong>Event Date:</strong>
                        {{ \Carbon\Carbon::parse($goalAssetDetails->event_date)->format('F j, Y, g:i A') }}
                    </p>
                 @endif

                @if ($goalAssetDetails->url != null)
                    <a href="{{ $goalAssetDetails->url }}" target="_blank"
                        class="inline-block mt-4 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition">
                        Visit Link
                    </a>
                @endif
                
            </div>
        </div>
    </div>


    <!-- Main Content -->
    <main class="flex-1 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white prose prose-invert prose-a:text-blue-400 hover:prose-a:text-blue-500">
            @if ($goalAssetDetails->short_description != null)
                {!! $goalAssetDetails->description !!}
            @else
                <p class="text-gray-200">No description available.</p>
            @endif
        </div>
    </main>
</div>
