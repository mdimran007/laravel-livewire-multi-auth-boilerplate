<div>
    <!-- Page Title Start -->
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? '' }}</h4>

    </div>
    <!-- Page Title End -->
    <div class="grid 2xl:grid-cols-1 grid-cols-1 gap-6">

        <div class="card">
            <div class="card-header">
                <p class="text-sm text-gray-500 dark:text-gray-500">
                    SDG Report
                </p>
            </div>
            <div class="p-6">
                <form wire:submit.prevent="updateSdgReportData">

                    <div class="grid grid-cols-1 md:grid-cols-1  gap-6 mb-4">
                        <div>
                            <label for="title"
                                class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Report Title') }}
                                <span class="text-danger">*</span></label>
                            <input type="text" wire:model="title" class="form-input" id="title"
                                placeholder="Report Title">
                            @error('title')
                                <span class="flex m-1 text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div wire:ignore>
                        <label for="summernote" class="text-gray-800 text-sm font-medium inline-block mb-2">Description
                        </label>
                        <textarea rows="3" class="form-input" id="summernote"></textarea>
                        @error('description')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="mt-12">
                        <label for="image" class="text-gray-800 text-sm font-medium inline-block mb-2">Image
                            (1600x1066)</label>
                        <input type="file" wire:model="image" class="border form-input p-1.5" id="image">
                        @if ($existingImage)
                            <div class="mt-2">
                                <img src="{{ asset('storage/research/' . $existingImage) }}" class="h-20">
                            </div>
                        @endif
                        @error('image')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-10 mt-4">
                            <label for="file" class="text-gray-800 text-sm font-medium inline-block mb-2">
                                {{ __('Report File') }}
                            </label>

                            <input type="file" wire:model="file" id="file"
                                class="border form-input p-1.5 rounded w-full">

                            {{-- Show new file preview --}}
                            @if ($oldFile)
                                <div class="mt-3">
                                    <p class="text-sm text-gray-500">Current File:</p>
                                    <a href="{{ asset('storage/' . $oldFile) }}" target="_blank"
                                        class="text-blue-500 underline">
                                        {{ basename($oldFile) }}
                                    </a>
                                </div>
                            @endif

                            @error('file')
                                <span class="flex m-1 text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    <button type="submit" class="btn bg-primary text-white" wire:loading.attr="disabled">
                        <span wire:loading.remove>{{ __('Save Now') }}</span>
                        <span wire:loading>
                            <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener('livewire:load', function() {
                initSummernote();
            });

            document.addEventListener('livewire:navigated', function() {
                initSummernote();
            });

            function initSummernote() {
                if ($('#summernote').next('.note-editor').length) {
                    $('#summernote').summernote('destroy');
                }
                $('#summernote').summernote({
                    placeholder: 'Write something...',
                    height: 200,
                    tabsize: 2,
                    callbacks: {
                        onChange: function(contents) {
                            @this.set('description', contents);
                        }
                    }
                });

                $('#summernote').summernote('code', @this.get('description') || '');
            }
        </script>
    @endpush
</div>
