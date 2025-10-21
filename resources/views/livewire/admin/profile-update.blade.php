<div>
    <!-- Page Title Start -->
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? '' }}</h4>
        <a href="{{ route('admin.goals.create') }}" class="btn bg-success text-white">
            + {{ __('Create Goal') }}
        </a>
    </div>
    <!-- Page Title End -->
    <div class="grid 2xl:grid-cols-1 grid-cols-1 gap-6">
        <div class="card">
            <div class="p-6">
                <div data-fc-type="tab">
                    <nav class="flex space-x-3 border-b" aria-label="Tabs">
                        <button data-fc-target="#tabs-with-underline-2" type="button"
                            class="fc-tab-active:font-semibold fc-tab-active:border-primary fc-tab-active:text-primary py-4 px-1 inline-flex items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap text-gray-500 hover:text-primary active">
                            Profile Update
                        </button>
                        <button data-fc-target="#tabs-with-underline-1" type="button"
                            class="fc-tab-active:font-semibold fc-tab-active:border-primary fc-tab-active:text-primary py-4 px-1 inline-flex items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap text-gray-500 hover:text-primary">
                            Password Update
                        </button>

                    </nav>

                    <div class="mt-3 overflow-hidden">

                        <div id="tabs-with-underline-2"
                            class="fc-tab-active:opacity-100 transition-all duration-300 transform opacity-0 active"
                            role="tabpanel" aria-labelledby="tabs-with-underline-item-2">
                            <form wire:submit.prevent="profileUpdate">
                                <div class="grid grid-cols-1 md:grid-cols-2  gap-6 mb-4">
                                    <div>
                                        <label for="name"
                                            class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Name') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="text" wire:model="name" class="form-input" id="name"
                                            placeholder="Name">
                                        @error('name')
                                            <span class="flex m-1 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2  gap-6 mb-4">
                                    <div>
                                        <label for="email"
                                            class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Email') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="text" wire:model="email" class="form-input" id="email"
                                            placeholder="Email">
                                        @error('email')
                                            <span class="flex m-1 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2  gap-6 mb-4">
                                    <div>
                                        <label for="phone"
                                            class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Phone') }}</label>
                                        <input type="text" wire:model="phone" class="form-input" id="phone"
                                            placeholder="Phone">
                                        @error('phone')
                                            <span class="flex m-1 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2  gap-6 mb-4">
                                    <div>
                                        <label for="dob"
                                            class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Date of birth') }}</label>
                                        <input type="date" wire:model="dob" class="form-input" id="dob"
                                            placeholder="Date of birth">
                                        @error('dob')
                                            <span class="flex m-1 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-1">
                                    <h6>Gender</h6>
                                    <div class="flex items-center gap-2 my-3">
                                        <div class="flex items-center gap-2 my-3">
                                            <input type="radio" wire:model="gender" value="{{ GENDER_MALE }}"
                                                id="genderMale" class="form-checkbox rounded border border-gray-200">
                                            <label class="text-gray-800 text-sm font-medium inline-block"
                                                for="genderMale">Male</label>
                                        </div>
                                        <div class="flex items-center gap-2 my-3">
                                            <input type="radio" wire:model="gender" value="{{ GENDER_FEMALE }}"
                                                id="genderFemale" class="form-checkbox rounded border border-gray-200">
                                            <label class="text-gray-800 text-sm font-medium inline-block"
                                                for="genderFemale">Female</label>
                                        </div>
                                        <div class="flex items-center gap-2 my-3">
                                            <input type="radio" wire:model="gender" value="{{ GENDER_OTHERS }}"
                                                id="genderOthers" class="form-checkbox rounded border border-gray-200">
                                            <label class="text-gray-800 text-sm font-medium inline-block"
                                                for="genderOthers">Others</label>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <span class="flex m-1 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="mb-10 mt-4">
                                        <label for="image"
                                            class="text-gray-800 text-sm font-medium inline-block mb-2">
                                            {{ __('Profile Image') }}
                                        </label>

                                        <input type="file" wire:model="image" id="image"
                                            class="border form-input p-1.5 rounded w-full">

                                        {{-- Show preview if new image is selected --}}
                                        @if ($image)
                                            <div class="mt-3">
                                                <p class="text-sm text-gray-500">Preview:</p>
                                                <img src="{{ $image->temporaryUrl() }}"
                                                    class="w-24 h-24 rounded-full object-cover border">
                                            </div>
                                        @elseif ($oldImage)
                                            {{-- Show old image if exists --}}
                                            <div class="mt-3">
                                                <p class="text-sm text-gray-500">Current Image:</p>
                                                <img src="{{ asset('storage/' . $oldImage) }}"
                                                    class="w-24 h-24 rounded-full object-cover border">
                                            </div>
                                        @endif

                                        @error('image')
                                            <span class="flex m-1 text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn bg-primary text-white"
                                    wire:loading.attr="disabled">
                                    <span wire:loading.remove>{{ __('Save Now') }}</span>
                                    <span wire:loading>
                                        <svg class="animate-spin h-5 w-5 text-white mr-2"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z">
                                            </path>
                                        </svg>
                                    </span>
                                </button>

                            </form>
                        </div>

                        <div id="tabs-with-underline-1"
                            class="fc-tab-active:opacity-100 opacity-0 transition-all duration-300 transform hidden"
                            role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
                            <form wire:submit.prevent="passwordUpdate">
                                <div class="grid grid-cols-1 md:grid-cols-2  gap-6 mb-4">
                                    <div>
                                        <label for="update_password_current_password"
                                            class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Current Password') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="password" wire:model="current_password" class="form-input"
                                            id="update_password_current_password" placeholder="Current Password">
                                        @error('current_password')
                                            <span class="flex m-1 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2  gap-6 mb-4">
                                    <div>
                                        <label for="update_password_password"
                                            class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('New Password') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="password" wire:model="password" class="form-input"
                                            id="update_password_password" placeholder="New Password">
                                        @error('password')
                                            <span class="flex m-1 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2  gap-6 mb-4">
                                    <div>
                                        <label for="update_password_password_confirmation"
                                            class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Confirm Password') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="password" wire:model="password_confirmation" class="form-input"
                                            id="update_password_password_confirmation" placeholder="Confirm Password">
                                        @error('password_confirmation')
                                            <span class="flex m-1 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn bg-primary text-white"
                                    wire:loading.attr="disabled">
                                    <span wire:loading.remove>{{ __('Save Now') }}</span>
                                    <span wire:loading>
                                        <svg class="animate-spin h-5 w-5 text-white mr-2"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z">
                                            </path>
                                        </svg>
                                    </span>
                                </button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


