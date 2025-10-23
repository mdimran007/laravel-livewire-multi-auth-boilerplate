<div>
    <!-- Page Title Start -->
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? '' }}</h4>
        <button wire:click="openUserModal" class="btn bg-success text-white">
            + {{ __('Create User') }}
        </button>
    </div>
    <!-- Page Title End -->

    <div class="mt-6">
        <div class="card">

            <div class="relative overflow-x-auto">
                <table class="w-full divide-y divide-gray-300 dark:divide-gray-700">
                    <thead
                        class="bg-slate-300 bg-opacity-20 border-t dark:bg-slate-800 divide-gray-300 dark:border-gray-700">
                        <tr>
                            <th scope="col"
                                class="py-3.5 ps-4 pe-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Picture</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Name</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Email</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Phone</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Status</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Created Date</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 ">
                        @forelse ($userList as $user)
                            <tr>
                                <td
                                    class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full"
                                            src="{{ $user->picture != null ? asset('storage/' . $user->picture) : asset('assets/no-image.png') }}"
                                            alt="Image">
                                    </div>
                                </td>
                                <td class="whitespace-nowrap py-4 pe-3 text-sm">
                                    <div class="flex items-center">
                                        <div class="font-medium text-gray-900 dark:text-gray-200 ms-4">
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                    {{ $user->email }}</td>

                                <td
                                    class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                    {{ $user->phone }}</td>


                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @if ($user->status == STATUS_ACTIVE)
                                        <div class="bg-success font-medium px-1.5 py-1 rounded-md text-white text-xs w-[3.375rem]"
                                            role="alert">
                                            <span>{{ __('Active') }}</span>
                                        </div>
                                    @else
                                        <div class="bg-warning/60 text-xs text-white rounded-md py-1 px-1.5 font-medium w-[3.375rem]"
                                            role="alert">
                                            <span>{{ __('Inactive') }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td
                                    class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                    {{ $user->created_at }}</td>

                                <td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
                                    <button wire:click="openUserModal({{ $user->id }})" class="me-0.5"> <i
                                            class="mgc_edit_line text-lg"></i>
                                    </button>
                                    <button wire:click="$dispatch('confirm-delete', {{ $user->id }})"
                                        class="ms-0.5"> <i class="mgc_delete_line text-xl"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="flex h-80 justify-center p-8">
                                        <div class="flex flex-col items-center justify-center h-64 text-gray-500">
                                            <!-- Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-12 h-12 mb-3 text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>

                                            <!-- Text -->
                                            <p class="text-lg font-medium">Data not found!</p>
                                        </div>

                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @if ($userModalOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto">
            <div
                class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-2xl p-6 relative my-10 overflow-y-auto max-h-[90vh]">


                <div class="flex justify-between items-center border-b border-gray-200 dark:border-slate-700 pb-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 capitalize">
                        {{ $isEdit != true?'Create New':'Edit' }}  User
                    </h3>
                    <button wire:click="closeUserModal"
                        class="dark:hover:text-gray-300 font-bold hover:bg-dark px-2 rounded text-2xl text-gray-400">&times;</button>
                </div>

                <div class="p-6">
                    <form wire:submit.prevent="userStore">

                        <div class="grid grid-cols-1 md:grid-cols-1  gap-6 mb-4">
                            <div>
                                <label for="userRole"
                                    class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('User Role') }}
                                    <span class="text-danger">*</span></label>
                                <select wire:model="role" class="form-input" id="userRole">
                                    <option value="">Select Role</option>
                                    @foreach ($roleList as $data)
                                        <option value="{{ $data->id }}"
                                            >{{ Str::ucfirst($data->name) }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('role')
                                    <span class="flex m-1 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-1  gap-6 mb-4">
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

                        <div class="grid grid-cols-1 md:grid-cols-1  gap-6 mb-4">
                            <div>
                                <label for="email"
                                    class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Email') }}
                                    <span class="text-danger">*</span></label>
                                <input type="email" wire:model="email" class="form-input" id="email"
                                    placeholder="Email">
                                @error('email')
                                    <span class="flex m-1 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-1  gap-6 mb-4">
                            <div>
                                <label for="password"
                                    class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Password') }}
                                    @if (!$isEdit)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <input type="password" wire:model="password" class="form-input" id="password"
                                    placeholder="Password">
                                @error('password')
                                    <span class="flex m-1 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-1  gap-6 mb-4">
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

                        <div class="grid grid-cols-1 md:grid-cols-1  gap-6 mb-4">
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

                        <!-- Gender -->
                        <div>
                            <label class="text-gray-800 text-sm font-medium mb-2 inline-block">Gender <span
                                    class="text-danger">*</span></label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-1">
                                    <input type="radio" wire:model="gender" value="{{ GENDER_MALE }}"
                                        class="form-radio">
                                    <span>Male</span>
                                </label>
                                <label class="flex items-center gap-1">
                                    <input type="radio" wire:model="gender" value="{{ GENDER_FEMALE }}"
                                        class="form-radio">
                                    <span>Female</span>
                                </label>
                                <label class="flex items-center gap-1">
                                    <input type="radio" wire:model="gender" value="{{ GENDER_OTHERS }}"
                                        class="form-radio">
                                    <span>Others</span>
                                </label>
                            </div>
                            @error('gender')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                            <div class="mb-10 mt-4">
                                <label for="image" class="text-gray-800 text-sm font-medium inline-block mb-2">
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

                        <button type="submit" class="btn bg-primary text-white" wire:loading.attr="disabled"
                            wire:target="userStore">
                            <span wire:loading.remove wire:target="userStore">Save Now</span>
                            <span wire:loading wire:target="userStore">
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
    @endif



</div>
