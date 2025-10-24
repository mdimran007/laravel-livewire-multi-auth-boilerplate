<div>
    <!-- Page Title Start -->
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? '' }}</h4>
        <button wire:click="openRoleModal" class="btn bg-success text-white">
            + {{ __('Create Role') }}
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
                                Name</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Created At</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 ">
                        @forelse ($roles as $data)
                            <tr>
                                
                                <td class="whitespace-nowrap py-4 pe-3 text-sm">
                                    <div class="flex items-center">
                                        <div class="font-medium text-gray-900 dark:text-gray-200 ms-4">
                                            {{ $data->name }}
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                    {{ $data->created_at }}</td>

                                <td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
                                    <button wire:click="openRoleModal({{ $data->id }})" class="me-0.5"> <i
                                            class="mgc_edit_line text-lg"></i>
                                    </button>
                                    <button wire:click="$dispatch('confirm-delete', {{ $data->id }})"
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


    @if ($roleModalOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto">
            <div
                class="bg-white dark:bg-slate-800 max-h-[90vh] max-w-4xl mt-auto my-10 overflow-y-auto p-6 relative rounded-2xl shadow-xl w-full">


                <div class="flex justify-between items-center border-b border-gray-200 dark:border-slate-700 pb-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 capitalize">
                        {{ $isEdit != true ? 'Create New' : 'Edit' }} Role
                    </h3>
                    <button wire:click="closeRoleModal"
                        class="dark:hover:text-gray-300 font-bold hover:bg-dark px-2 rounded text-2xl text-gray-400">&times;</button>
                </div>

                <div class="p-6">
                    <form wire:submit.prevent="roleStore">

                        <div class="grid grid-cols-1 md:grid-cols-1  gap-6 mb-4">
                            <div>
                                <label for="name"
                                    class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __('Name') }}
                                    <span class="text-danger">*</span></label>
                                <input type="text" wire:model="name" class="form-input" id="name" {{ $name == 'admin'? 'disabled':'' }}
                                    placeholder="Name">
                                @error('name')
                                    <span class="flex m-1 text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


            
                        @php
                            $permissions = permissionArrayList();
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <label class="text-gray-800 text-sm font-medium mb-2 inline-block">Select Permission <span
                                    class="text-danger">*</span></label>
                                    <br>
                            @foreach ($permissions as $key => $value)
                                {{-- If permission has sub-items --}}
                                @if (is_array($value))
                                    <div class="border border-gray-200 rounded-lg p-4 shadow-sm bg-white">
                                        <h3
                                            class="font-semibold text-gray-700 mb-3 capitalize flex items-center justify-between">
                                            {{ Str::title($key) }}
                                            <button type="button" class="text-xs text-blue-500 hover:underline"
                                                onclick="toggleGroup('{{ $key }}')">Select All</button>
                                        </h3>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            @foreach ($value as $perm)
                                                <label class="flex items-center space-x-2 text-gray-700">
                                                    <input type="checkbox" wire:model="selectedPermissions" {{ $name == 'admin'? 'disabled':'' }}
                                                        value="{{ $key . '.' . $perm }}"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200 group-{{ $key }}">
                                                    <span class="capitalize">{{ str_replace('-', ' ', $perm) }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    {{-- Single (top-level) permission --}}
                                    <div class="border border-gray-200 rounded-lg p-4 shadow-sm bg-white">
                                        <label class="flex items-center space-x-2 text-gray-700">
                                            <input type="checkbox" wire:model="selectedPermissions" {{ $name == 'admin'? 'disabled':'' }}
                                                value="{{ $value }}"
                                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200">
                                            <span class="capitalize">{{ str_replace('-', ' ', $value) }}</span>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>



                        @if ($name != 'admin')
                            
                        
                        <button type="submit" class="bg-primary btn mt-9 text-white" wire:loading.attr="disabled"
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
                        @endif
                    </form>
                </div>

            </div>
        </div>
    @endif

    @push('script')
        <script>
            function toggleGroup(group) {
                const checkboxes = document.querySelectorAll(`.group-${group}`);
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                checkboxes.forEach(cb => cb.checked = !allChecked);
                // trigger Livewire model update
                checkboxes[0]?.dispatchEvent(new Event('change'));
            }
        </script>
    @endpush


</div>
