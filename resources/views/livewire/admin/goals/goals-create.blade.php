<div>
                   <!-- Page Title Start -->
                <div class="flex items-center justify-between mb-6">
                    <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? '' }}</h4>
                    <a href="{{ route('admin.goals') }}"
                        class="btn bg-success text-white" wire:navigate>
                        + {{ __("Back") }}
                    </a>
                </div>
                <!-- Page Title End -->

                     <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
                        <div class="col-span-2">
                            <div class="card">
                                <div class="p-6">
                                    <form wire:submit.prevent="store">
                                        <div class="grid grid-cols-1 md:grid-cols-2  gap-6">
                                            <div>
                                                <label for="title" class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __("Title") }} <span class="text-danger">*</span></label>
                                                <input type="text" wire:model="title" class="form-input" id="title" placeholder="Title">
                                                @error('title') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                <label for="status" class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __("Status") }}  <span class="text-danger">*</span></label>
                                                <select id="status" class="form-select" wire:model="status">
                                                    <option>{{ __("Choose") }}</option>
                                                    <option value="{{ STATUS_ACTIVE }}">{{ __("Active") }}</option>
                                                    <option value="{{ STATUS_INACTIVE }}">{{ __("Inactive") }}</option>
                                                </select>
                                                @error('status') <span class="error">{{ $message }}</span> @enderror
                                            </div>

                                        </div>

                                        <div class="grid grid-cols-1 gap-6">
                                            <div class="mt-5">
                                                <label for="inputPassword4" class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __("Short Description") }}  <span class="text-danger">*</span></label>
                                              <textarea id="bubble-editor" wire:model="short_description" rows="6" class="form-input" placeholder="Short Description"></textarea>
                                              @error('short_description') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                         <div class="grid grid-cols-1 md:grid-cols-2  gap-6">
                                            <div class="mb-10 mt-12">
                                                    <label for="image" class="text-gray-800 text-sm font-medium inline-block mb-2">{{ __("Image") }}  <span class="text-danger">*</span></label>
                                                    <input type="file" wire:model="image" class="border form-input p-1.5" id="image" >
                                                    @error('image') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                         </div>

                                         <div class="grid grid-cols-1 md:grid-cols-1">
                                            <h6>Select max 4 item for showing on the counter.</h6>
                                            <div class="flex items-center gap-2 my-3">
                                                @foreach (goalItemList() as $key=>$item)
                                                    <div class="flex items-center gap-2 my-3">
                                                        <input type="checkbox" wire:model="selectedItems" value="{{ $item }}" class="form-checkbox rounded border border-gray-200" id="{{ $key }}">
                                                        <label class="text-gray-800 text-sm font-medium inline-block" for="{{ $key }}">{{ Str::ucfirst($item) }}</label>
                                                    </div>
                                                @endforeach
                                              
                                            </div>
                                                     @error('selectedItems') <span class="error">{{ $message }}</span> @enderror

                                         </div>

                                        <button type="submit" class="btn bg-primary text-white">{{ __("Save Now") }}</button>
                                    </form>
                                </div>
                            </div>
                        </div> 
                </div>
</div>
