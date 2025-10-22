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
                        <tr>
                            <td
                                class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="assets/images/users/avatar-9.jpg"
                                        alt="">
                                </div>
                            </td>
                            <td class="whitespace-nowrap py-4 pe-3 text-sm">
                                <div class="flex items-center">
                                    <div class="font-medium text-gray-900 dark:text-gray-200 ms-4">Lindsay Walton</div>
                                </div>
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                test@gmail.com</td>

                            <td
                                class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                01763732521</td>


                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div
                                    class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-dark/80 text-white">
                                    Closed</div>
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                13/08/2011</td>

                            <td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
                                <a href="javascript:void(0);" class="me-0.5"> <i class="mgc_edit_line text-lg"></i> </a>
                                <a href="javascript:void(0);" class="ms-0.5"> <i class="mgc_delete_line text-xl"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @if ($userModalOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full p-6 relative"
                style="max-width: 1300px;">

                <div class="flex justify-between items-center border-b border-gray-200 dark:border-slate-700 pb-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 capitalize">
                        Create New User
                    </h3>
                    <button wire:click="closeUserModal"
                        class="dark:hover:text-gray-300 font-bold hover:bg-dark px-2 rounded text-2xl text-gray-400">&times;</button>
                </div>

                <div class="p-6">
                    <form wire:submit.prevent="profileUpdate">
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
                                <label for="userRole"
                                    class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Email') }}
                                    <span class="text-danger">*</span></label>
                                <select wire:model="role" class="form-input" id="userRole">
                                    <option value="2">Admin</option>
                                    <option value="3">Staff</option>
                                </select>

                                @error('email')
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
                            wire:target="profileUpdate">
                            <span wire:loading.remove wire:target="profileUpdate">Save Now</span>
                            <span wire:loading wire:target="profileUpdate">
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
