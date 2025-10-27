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


                    <form wire:submit.prevent="update">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-gray-800 text-sm font-medium mb-2 inline-block">Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model="title" class="form-input" placeholder="Title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="text-gray-800 text-sm font-medium mb-2 inline-block">Status <span
                                        class="text-danger">*</span></label>
                                <select wire:model="status" class="form-select">
                                    <option>{{ __('Choose') }}</option>
                                    <option value="{{ STATUS_ACTIVE }}">{{ __('Active') }}</option>
                                    <option value="{{ STATUS_INACTIVE }}">{{ __('Inactive') }}</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5">
                            <label class="text-gray-800 text-sm font-medium mb-2 inline-block">Short Description <span
                                    class="text-danger">*</span></label>
                            <textarea wire:model="short_description" rows="6" class="form-input" placeholder="Short Description"></textarea>
                            @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label class="text-gray-800 text-sm font-medium mb-2 inline-block">{{ __('Image') }}
                                   (626x256) <span class="text-danger">*</span></label>
                                <input type="file" wire:model="image" class="form-input p-1.5 border">
                                @if ($old_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $old_image) }}" alt="Goal Image"
                                            class="h-20 w-20 object-cover rounded">
                                    </div>
                                @endif
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label class="text-gray-800 text-sm font-medium mb-2 inline-block">{{ __('SDG Image') }}
                                   (200x200) <span class="text-danger">*</span></label>
                                <input type="file" wire:model="sdg_image" class="form-input p-1.5 border">
                                @if ($old_sdg_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $old_sdg_image) }}" alt="SDG Image"
                                            class="h-20 w-20 object-cover rounded">
                                    </div>
                                @endif
                                @error('sdg_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <h6>Select max 4 items for showing on the counter.<span class="text-danger">*</span></h6>
                            <div class="flex flex-wrap gap-4 my-3">
                                @foreach (goalItemList() as $key => $item)
                                    <div class="flex items-center gap-2">
                                        <input type="checkbox" wire:model="selectedItems" value="{{ $item }}"
                                            class="form-checkbox rounded border-gray-300">
                                        <label
                                            class="text-gray-800 text-sm font-medium">{{ Str::ucfirst($item) }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('selectedItems')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn bg-primary text-white mt-4" wire:loading.attr="disabled">
                            <span wire:loading.remove>Update Goal</span>
                            <span wire:loading>
                                <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
