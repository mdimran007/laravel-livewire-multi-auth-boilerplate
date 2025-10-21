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
                    General Settings
                </p>
            </div>
            <div class="p-6">
                <form wire:submit.prevent="storeGeneralSettingData">

                    <div class="grid grid-cols-1 md:grid-cols-2  gap-6 mb-4">
                        <div>
                            <label for="appName"
                                class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Application Name') }}
                                <span class="text-danger">*</span></label>
                            <input type="text" wire:model="app_name" class="form-input" id="appName"
                                placeholder="Application Name">
                            @error('app_name')
                                <span class="flex m-1 text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2  gap-6 mb-4">
                        <div>
                            <label for="appContact"
                                class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Application Contact') }}
                            </label>
                            <input type="text" wire:model="app_contact" class="form-input" id="appContact"
                                placeholder="Application Contact">
                            @error('app_contact')
                                <span class="flex m-1 text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2  gap-6 mb-4">
                        <div>
                            <label for="appEmail"
                                class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Application Email') }}
                                <span class="text-danger">*</span></label>
                            <input type="email" wire:model="app_email" class="form-input" id="appEmail"
                                placeholder="Application Email">
                            @error('email')
                                <span class="flex m-1 text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2  gap-6 mb-4">
                        <div>
                            <label for="appAddress"
                                class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Application Address') }}
                                <span class="text-danger">*</span></label>
                            <textarea wire:model="app_address" rows="3" class="form-input" id="appAddress"></textarea>
                            @error('app_address')
                                <span class="flex m-1 text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-10 mt-4">
                            <label for="image" class="text-gray-800 text-sm font-medium inline-block mb-2">
                                {{ __('Site Logo') }}
                            </label>

                            <input type="file" wire:model="app_logo" id="image"
                                class="border form-input p-1.5 rounded w-full">

                            {{-- Show preview if new image is selected --}}
                            @if ($app_logo)
                                <div class="mt-3">
                                    <p class="text-sm text-gray-500">Preview:</p>
                                    <img src="{{ $app_logo->temporaryUrl() }}"
                                        class="w-24 h-24 rounded-full object-cover border">
                                </div>
                            @elseif ($oldAppLogo)
                                {{-- Show old image if exists --}}
                                <div class="mt-3">
                                    <p class="text-sm text-gray-500">Current Image:</p>
                                    <img src="{{ asset('storage/' . $oldAppLogo) }}"
                                        class="w-24 h-24 rounded-full object-cover border">
                                </div>
                            @endif

                            @error('app_logo')
                                <span class="flex m-1 text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-10 mt-4">
                            <label for="institute_logo" class="text-gray-800 text-sm font-medium inline-block mb-2">
                                {{ __('Institute Logo') }}
                            </label>

                            <input type="file" wire:model="institute_logo" id="institute_logo"
                                class="border form-input p-1.5 rounded w-full">

                            {{-- Show preview if new image is selected --}}
                            @if ($institute_logo)
                                <div class="mt-3">
                                    <p class="text-sm text-gray-500">Preview:</p>
                                    <img src="{{ $institute_logo->temporaryUrl() }}"
                                        class="w-24 h-24 rounded-full object-cover border">
                                </div>
                            @elseif ($oldInstituteLogo)
                                {{-- Show old image if exists --}}
                                <div class="mt-3">
                                    <p class="text-sm text-gray-500">Current Image:</p>
                                    <img src="{{ asset('storage/' . $oldInstituteLogo) }}"
                                        class="w-24 h-24 rounded-full object-cover border">
                                </div>
                            @endif

                            @error('institute_logo')
                                <span class="flex m-1 text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-10 mt-4">
                            <label for="app_favicon" class="text-gray-800 text-sm font-medium inline-block mb-2">
                                {{ __('App Favicon') }}
                            </label>

                            <input type="file" wire:model="app_favicon" id="app_favicon"
                                class="border form-input p-1.5 rounded w-full">

                            {{-- Show preview if new image is selected --}}
                            @if ($app_favicon)
                                <div class="mt-3">
                                    <p class="text-sm text-gray-500">Preview:</p>
                                    <img src="{{ $app_favicon->temporaryUrl() }}"
                                        class="w-24 h-24 rounded-full object-cover border">
                                </div>
                            @elseif ($oldAppFavicon)
                                {{-- Show old image if exists --}}
                                <div class="mt-3">
                                    <p class="text-sm text-gray-500">Current Image:</p>
                                    <img src="{{ asset('storage/' . $oldAppFavicon) }}"
                                        class="w-24 h-24 rounded-full object-cover border">
                                </div>
                            @endif

                            @error('app_favicon')
                                <span class="flex m-1 text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

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
