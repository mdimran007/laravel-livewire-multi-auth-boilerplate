<div>
    <!-- Page Title Start -->
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? '' }}</h4>
        <a href="{{ route('admin.goals') }}" class="bg-indigo-600 btn text-white">
            {{ __('Back') }}
        </a>
    </div>
    <!-- Page Title End -->

    <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
        <div class="col-span-2">
            <div class="card">
                <div class="p-6">
                    @if (session()->has('message'))
                        <div wire:poll.5s class="bg-green-200 text-green-800 p-3 rounded mb-4">
                            {{ session('message') }}
                        </div>
                    @endif


                    <form wire:submit.prevent="store">
                        <div class="grid grid-cols-1 md:grid-cols-2  gap-6">
                            <div>
                                <label for="title"
                                    class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Title') }}
                                    <span class="text-danger">*</span></label>
                                <input type="text" wire:model="title" class="form-input" id="title"
                                    placeholder="Title">
                                @error('title')
                                    <span class="flex m-1 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="status"
                                    class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Status') }}
                                    <span class="text-danger">*</span></label>
                                <select id="status" class="form-select" wire:model="status">
                                    <option>{{ __('Choose') }}</option>
                                    <option value="{{ STATUS_ACTIVE }}">{{ __('Active') }}</option>
                                    <option value="{{ STATUS_INACTIVE }}">{{ __('Inactive') }}</option>
                                </select>
                                @error('status')
                                    <span class="flex m-1 text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <div class="mt-5">
                                <label for="inputPassword4"
                                    class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Short Description') }}
                                    <span class="text-danger">*</span></label>
                                <textarea id="bubble-editor" wire:model="short_description" rows="6" class="form-input"
                                    placeholder="Short Description"></textarea>
                                @error('short_description')
                                    <span class="flex m-1 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2  gap-6">
                            <div class="mb-10 mt-12">
                                <label for="image"
                                    class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Image') }}
                                   (1600x1066) <span class="text-danger">*</span></label>
                                <input type="file" wire:model="image" class="border form-input p-1.5" id="image">
                                @error('image')
                                    <span class="flex m-1 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2  gap-6">
                            <div class="mb-10 mt-1">
                                <label for="sdg_image"
                                    class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('SDG Image') }}
                                   (200x200) <span class="text-danger">*</span></label>
                                <input type="file" wire:model="sdg_image" class="border form-input p-1.5" id="sdg_image">
                                @error('sdg_image')
                                    <span class="flex m-1 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-1">
                            <h6>Select max 6 item for showing on the counter. <span class="text-danger">*</span></h6>
                            <div class="flex items-center gap-2 my-3">
                                @foreach (goalItemList() as $key => $item)
                                    <div class="flex items-center gap-2 my-3">
                                        <input type="checkbox" wire:model="selectedItems" value="{{ $item }}"
                                            class="form-checkbox rounded border border-gray-200"
                                            id="{{ $key }}">
                                        <label class="text-gray-800 text-sm font-medium inline-block"
                                            for="{{ $key }}">{{ Str::ucfirst($item) }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('selectedItems')
                                <span class="flex m-1 text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <button type="submit" class="btn bg-primary text-white">{{ __("Save Now") }}</button> --}}

                        {{-- <div id="snow-editor" style="height: 300px;"></div> --}}

                        <button type="submit" class="btn bg-primary text-white" wire:loading.attr="disabled">
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
</div>
