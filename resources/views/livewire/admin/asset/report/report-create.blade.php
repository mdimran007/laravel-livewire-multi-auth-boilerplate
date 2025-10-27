<div>
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? 'Services' }}</h4>
        <a href="{{ url()->previous() }}" class="btn bg-success text-white">
            + {{ __('Back') }}
        </a>
    </div>

    <div class="mt-6">
        <div class="card">
            <div class="relative overflow-x-auto">
                <div class="p-6">
                    <form wire:submit.prevent="store" class="mt-5 space-y-4">

                        <div wire:ignore>
                            <label for="goal" class="text-gray-800 text-sm font-medium inline-block mb-2">Select
                                Goals</label>
                            <select id="goal" class="form-input js-example-basic-multiple" multiple>
                                @foreach ($goalList as $goal)
                                    <option value="{{ $goal->id }}">{{ $goal->title }}</option>
                                @endforeach
                            </select>
                            @error('goals')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-10">
                            <label for="title" class="font-medium inline-block mb-2 mt-5 text-gray-800 text-sm">Title
                                <span class="text-red-500 text-xs">*</span></label>
                            <input type="text" wire:model="title" class="form-input" id="title">
                            @error('title')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                        </div>

                        <div>
                            <label for="short_description"
                                class="text-gray-800 text-sm font-medium inline-block mb-2">Short
                                Description <span class="text-red-500 text-xs">*</span></label>
                            <textarea wire:model="short_description" rows="3" class="form-input" id="short_description"></textarea>
                            @error('short_description')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                        </div>

                        <div wire:ignore>
                            <label for="summernote"
                                class="text-gray-800 text-sm font-medium inline-block mb-2">Description
                            </label>
                            <textarea rows="3" class="form-input" id="summernote"></textarea>
                            @error('description')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                        </div>

                        <div>
                            <label for="url" class="text-gray-800 text-sm font-medium inline-block mb-2">Url
                            </label>
                            <input type="text" wire:model="url" class="form-input" id="url">
                            @error('url')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                        </div>

                        <div>
                            <label for="image" class="text-gray-800 text-sm font-medium inline-block mb-2">Image
                            </label>
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

                        <div>
                            <label for="status"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                            <select wire:model="status" class="form-input mt-2" id="status">
                                <option value="{{ STATUS_ACTIVE }}">Active</option>
                                <option value="{{ STATUS_INACTIVE }}">Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="bg-success hover:bg-green-700 mt-7 px-4 py-2 rounded-md text-white transition"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove>{{ __('Save Now') }}</span>
                            <span wire:loading>
                                <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                            </span>
                        </button>


                    </form>


                </div>
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

        <script>
            document.addEventListener('livewire:load', function() {
                initSelect2();
            });

            document.addEventListener('livewire:navigated', function() {
                initSelect2();
            });

            function initSelect2() {
                const select = $('.js-example-basic-multiple');
                const compEl = select.closest('[wire\\:id]');
                if (!compEl.length) return;
                const component = Livewire.find(compEl.attr('wire:id'));
                if (!component) return;

                // destroy if already initialized
                if (select.hasClass("select2-hidden-accessible")) {
                    select.select2('destroy');
                }

                select.select2({
                    placeholder: 'Select an option',
                    theme: 'classic'
                });

                // When value changes in Select2, update Livewire
                select.on('change', function(e) {
                    const data = $(this).val();
                    component.set('goals', data);
                });

                // Set initial selected values from Livewire property
                const selected = component.get('goals') || [];
                select.val(selected).trigger('change');
            }
        </script>
    @endpush

</div>
