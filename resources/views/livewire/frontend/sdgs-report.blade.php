<div>
    <section class="flex justify-center mb-8 text-center">
        <!-- You can add a header/title here if needed -->
    </section>

    <section class="relative py-12 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto rounded-3xl overflow-hidden bg-white/10 p-1" style="max-width: 80%;">
            @if ($sdgReport != null)


                <div class="mx-auto mt-10">
                    <div
                        class="flex flex-col md:flex-row bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">

                        {{-- Image Section --}}
                        <div class="md:w-1/3 flex-shrink-0">
                            @if ($sdgReport->images)
                                <img src="{{ $sdgReport->images ? asset('storage/' . $sdgReport->images) : '/path/to/default-image.png' }}"
                                    alt="{{ $sdgReport->title }}" class="w-full h-full object-cover">
                            @else
                                <img src="/path/to/default-image.png" alt="Report Image"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>

                        {{-- Content Section --}}
                        <div class="bg-indigo-600 flex-col justify-between md:w-2/3 p-6 text-white">
                            <div>
                                <h2 class="font-bold mb-4 text-2xl text-gray-800 text-white">{{ $sdgReport->title }}
                                </h2>
                                <p class="leading-relaxed mb-6 text-gray-600 text-sm text-white">{!! $sdgReport->description !!}
                                </p>
                            </div>

                            @if ($sdgReport->file)
                                <a href="{{ asset('storage/' . $sdgReport->file) }}" target="_blank"
                                    class="bg-white/20 font-medium inline-flex items-center px-4 py-2 rounded text-white transition">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v12a1 1 0 11-2 0V5H5v11h7a1 1 0 110 2H4a1 1 0 01-1-1V4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Download
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex h-80 justify-center p-8">
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
