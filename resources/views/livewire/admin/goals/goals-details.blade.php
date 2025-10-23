<div>
    <!-- Page Title Start -->
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? '' }}</h4>
        <a href="{{ route('admin.goals') }}" class="bg-indigo-600 btn text-white">
            {{ __('Back') }}
        </a>
    </div>
    <!-- Page Title End -->
    <div class="grid lg:grid-cols-3 gap-6">


        <div class="lg:col-span-3">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title">{{ $title }}</h5>
                        @if ($status == STATUS_ACTIVE)
                            <div class="bg-success text-xs text-white rounded-md py-1 px-1.5 font-medium"
                                role="alert">
                                <span>{{ __('Active') }}</span>
                            </div>
                        @else
                            <div class="bg-warning/60 text-xs text-white rounded-md py-1 px-1.5 font-medium"
                                role="alert">
                                <span>{{ __('Inactive') }}</span>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="p-6">
                    <div>

                        @if ($image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $image) }}" alt="Goal Image"
                                    class="h-40 w-40 object-cover rounded">
                            </div>
                        @endif

                        <p class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ __('Description') }}
                            :{{ $short_description }}</p>

                        @if ($selectedItems)
                            <div class="mb-6">
                                <h6 class="font-medium my-3 text-gray-800">
                                    {{ __('Selected assets for showing on the counter') }}</h6>
                                <div class="uppercase flex gap-4">
                                    @foreach ($selectedItems as $singleAsset)
                                        <span
                                            class="inline-flex items-center font-semibold py-1 px-2 rounded text-xs bg-primary/20 text-primary">{{ $singleAsset }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @else
                        @endif


                        <div class="grid grid-cols-4 gap-6">
                            <div class="">
                                <div class="">
                                    <p class="mb-3 text-sm uppercase font-medium"><i
                                            class="uil-calender text-red-500 text-base"></i> {{ __('Created At') }}</p>
                                    <h5 class="text-base text-gray-700 dark:text-gray-300 font-medium">
                                        {{ $createdAt->diffForHumans() }}</h5>
                                </div>
                            </div>
                            <div class="">
                                <p class="mb-3 text-sm uppercase font-medium"><i
                                        class="uil-calendar-slash text-red-500 text-base"></i> {{ __('Updated At') }}
                                </p>
                                <h5 class="text-base text-gray-700 dark:text-gray-300 font-medium">
                                    {{ $updatedAt->diffForHumans() }}</h5>
                            </div>
                            <div class="">
                                <p class="mb-3 text-sm uppercase font-medium"><i
                                        class="uil-calendar-slash text-red-500 text-base"></i> {{ __('Created By') }}
                                </p>
                                <h5 class="text-base text-gray-700 dark:text-gray-300 font-medium">{{ $createdBy }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       

        <!-- Policy-->
            {{-- <div class="lg:col-span-3">
                <div class="card">
                    <div class="card-header">
                        <div class="flex justify-between items-center">
                            <h5 class="card-title">adsfasdfasdf</h5>
                        </div>
                    </div>
                    <div class="p-6">
                        @if ($total_policies > 0)
                            <div class="grid lg:grid-cols-4 gap-6">
                                @foreach ($policiesData as $singleAsset)
                                    <a href="#" wire:click="openAssetDetailsModal({{ $singleAsset->id }})">
                                        <div wire:key="item-{{ $singleAsset->id }}"
                                            class="bg-white border max-w-[490px] overflow-hidden rounded-lg shadow-[0_0_1rem_rgba(0,0,0,0.2)] w-[100%]">
                                            <div class="bg-slate-200 card">
                                                <div class="grid grid-cols-5">
                                                    <div class="col-span-2 p-3">
                                                        @if ($singleAsset->images)
                                                            <img src="{{ asset('storage/' . $singleAsset->images) }}"
                                                                alt="Image"
                                                                class="w-24 h-24 rounded-l-lg object-cover">
                                                        @else
                                                            <img src="{{ asset('assets/no-image.png') }}"
                                                                alt="Image"
                                                                class="w-24 h-24 rounded-l-lg object-cover">
                                                        @endif
                                                    </div>
                                                    <div class="col-span-3 p-3">
                                                  

                                                        <div class="font-bold">
                                                            {{ $singleAsset->title != null ? \Illuminate\Support\Str::limit($singleAsset->title, 34, '...') : 'N/A' }}
                                                        </div>
                                                        <div class="mb-3">
                                                            {{ $singleAsset->short_description != null ? \Illuminate\Support\Str::limit($singleAsset->short_description, 43, '...') : 'N/A' }}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                @endforeach
                            </div>
                        @else
                            <div class="grid md:grid-cols-1 xl:grid-cols-1 gap-6">
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
                                        <p class="text-lg font-medium">{{ Str::ucfirst($key) }} not found!</p>
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div> --}}

    </div>


    @if ($isAssetDetailsModalOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full p-6 relative"
                style="max-width: 1300px;">

                <div class="flex justify-between items-center border-b border-gray-200 dark:border-slate-700 pb-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 capitalize">
                        {{ $asset_data?->title ?? 'N/A' }}
                    </h3>
                    <button wire:click="closeAssetDetailsModal"
                        class="dark:hover:text-gray-300 font-bold hover:bg-dark px-2 rounded text-2xl text-gray-400">&times;</button>
                </div>

                <div class="p-6">
                    <div>

                        @if (isset($asset_data->title) && !empty($data->title))
                            <h1 class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ Str::ucfirst($asset_type) }}
                                {{ __(' Title') }}
                                : <span class="text">{{ $data->title }}</span></h1>
                        @endif

                        @if (isset($asset_data->event_date) && !empty($data->event_date))
                            <h1 class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ Str::ucfirst($asset_type) }}
                                {{ __(' Date') }}
                                : <span class="text">{{ $data->event_date }}</span></h1>
                        @endif


                        @if (isset($asset_data->image) && !empty($data->image))
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $data->image) }}" alt="Image"
                                    class="h-40 w-40 object-cover rounded">
                            </div>
                        @endif

                        @if (isset($asset_data->short_description) && !empty($data->short_description))
                            <h1 class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ __('Short Description') }}: </h1>
                            <p class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ $data->short_description }}</p>
                        @endif


                        @if (isset($asset_data->description) && !empty($data->description))
                            <h1 class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ __('Description') }}: </h1>
                            <p class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ $data->description }}</p>
                        @endif

                        @if (isset($asset_data->url) && !empty($data->url))
                            <h1 class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ __(' Url') }}
                                : <a href="{{ $data->url }}" target="_blank" class="text text-sky-500">Click
                                    Here</a></h1>
                        @endif

                        <div class="grid grid-cols-4 gap-6">
                            <div class="">
                                <div class="">
                                    <p class="mb-3 text-sm uppercase font-medium"><i
                                            class="uil-calender text-red-500 text-base"></i> {{ __('Created At') }}
                                    </p>
                                    <h5 class="text-base text-gray-700 dark:text-gray-300 font-medium">
                                        {{ $asset_createdAt->diffForHumans() }}</h5>
                                </div>
                            </div>
                            <div class="">
                                <p class="mb-3 text-sm uppercase font-medium"><i
                                        class="uil-calendar-slash text-red-500 text-base"></i> {{ __('Updated At') }}
                                </p>
                                <h5 class="text-base text-gray-700 dark:text-gray-300 font-medium">
                                    {{ $asset_updatedAt->diffForHumans() }}</h5>
                            </div>
                            <div class="">
                                <p class="mb-3 text-sm uppercase font-medium"><i
                                        class="uil-calendar-slash text-red-500 text-base"></i> {{ __('Created By') }}
                                </p>
                                <h5 class="text-base text-gray-700 dark:text-gray-300 font-medium">
                                    {{ $asset_createdBy }}
                                </h5>
                            </div>
                        </div>

                        <div class="mt-5">
                            @if ($asset_status == STATUS_ACTIVE)
                                <span class="bg-success text-xs text-white rounded-md py-1 px-1.5 font-medium"
                                    role="alert">{{ __('Active') }}</span>
                            @else
                                <span class="bg-warning/60 text-xs text-white rounded-md py-1 px-1.5 font-medium"
                                    role="alert">{{ __('Inactive') }}</span>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    @endif

</div>
