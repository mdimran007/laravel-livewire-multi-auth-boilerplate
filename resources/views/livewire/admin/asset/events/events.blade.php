<div>
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? 'Research' }}</h4>
        <a href="{{ route('admin.events.create') }}" class="btn bg-success text-white">
            + {{ __('Add New') }}
        </a>
    </div>

    <div class="mt-6">
        <div class="card">
            <div class="relative overflow-x-auto">
                <div class="p-6">

                    @if (!$dataList->isEmpty())
                        <div class="grid lg:grid-cols-4 gap-6">
                            @foreach ($dataList as $data)
                                <div wire:key="item-{{ $data->id }}"
                                    class="bg-white border max-w-[490px] overflow-hidden rounded-lg shadow-[0_0_1rem_rgba(0,0,0,0.2)] w-[100%]">
                                    <div class="bg-slate-200 card min-h-full">
                                        <div class="grid grid-cols-5">
                                            <div class="col-span-2 p-3">

                                                @if ($data->images)
                                                    <img src="{{ asset('storage/' . $data->images) }}" alt="Image"
                                                        class="w-24 h-24 rounded-l-lg object-cover">
                                                @else
                                                    <img src="{{ asset('assets/no-image.png') }}" alt="Image"
                                                        class="w-24 h-24 rounded-l-lg object-cover">
                                                @endif
                                            </div>
                                            <div class="col-span-3 p-3">


                                                <div class="font-bold">
                                                    {{ $data->title != null ? \Illuminate\Support\Str::limit($data->title, 34, '...') : 'N/A' }}
                                                </div>
                                                <div class="mb-3">
                                                    {{ $data->short_description != null ? \Illuminate\Support\Str::limit($data->short_description, 43, '...') : 'N/A' }}
                                                </div>


                                                <div class="flex mt-3 gap-2">
                                                    <button title="{{ __('View') }}" wire:click="detailsModalOpenAction({{ $data->id }})"
                                                        class="bg-primary border-2 flex-1 hover:bg-gray-400 px-4 py-2 rounded-lg text-gray-500 text-white">
                                                        <i class="msr">preview</i>
                                                    </button>
                                                    <a href="{{ route('admin.events.edit', $data->id) }}"
                                                        title="{{ __('Edit') }}"
                                                        class="bg-primary border-2 flex-1 hover:bg-gray-400 px-4 py-2 rounded-lg text-gray-500 text-white">
                                                        <i class="msr">edit_square</i>
                                                    </a>
                                                    <button title="{{ __('Delete') }}"
                                                        wire:click="$dispatch('confirm-delete', {{ $data->id }})"
                                                        class="bg-danger border-2 flex-1 hover:bg-gray-400 px-4 py-2 rounded-lg text-gray-500 text-white">
                                                        <i class="msr">delete</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @else
                        <div class="grid md:grid-cols-1 xl:grid-cols-1 gap-6">
                            <div class="flex h-80 justify-center p-8">
                                <div class="flex flex-col items-center justify-center h-64 text-gray-500">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-3 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                    <!-- Text -->
                                    <p class="text-lg font-medium">Data not found!</p>
                                </div>

                            </div>
                        </div>
                    @endif



                </div>
            </div>
        </div>

        <!-- Custom Pagination -->
        <div class="flex justify-between items-center mt-4">
            <div>
                Showing {{ $dataList->firstItem() }} to {{ $dataList->lastItem() }} of
                {{ $dataList->total() }} results
            </div>

            <div class="flex space-x-1">
                @if ($dataList->onFirstPage())
                    <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Previous</span>
                @else
                    <button wire:click="previousPage"
                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Previous</button>
                @endif

                @foreach ($dataList->getUrlRange(1, $dataList->lastPage()) as $page => $url)
                    <button wire:click="gotoPage({{ $page }})"
                        class="px-3 py-1 rounded {{ $page == $dataList->currentPage() ? 'bg-slate-700 px-3 py-1 rounded text-white' : 'bg-gray-200 text-gray-700' }}">
                        {{ $page }}
                    </button>
                @endforeach

                @if ($dataList->hasMorePages())
                    <button wire:click="nextPage"
                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next</button>
                @else
                    <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Next</span>
                @endif
            </div>
        </div>
    </div>

    @if ($isDetailsModalOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full p-6 relative"
                style="max-width: 1300px;">

                <div class="flex justify-between items-center border-b border-gray-200 dark:border-slate-700 pb-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 capitalize">
                        Details
                    </h3>
                    <button wire:click="closeDetailsModalAction"
                        class="dark:hover:text-gray-300 font-bold hover:bg-dark px-2 rounded text-2xl text-gray-400">&times;</button>
                </div>

                <div class="p-6">
                    <div>

                        @if (isset($title) && !empty($title))
                            <h1 class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">
                                {{ __(' Title') }}
                                : <span class="text">{{ $title }}</span></h1>
                        @endif

                        {{-- @if (isset($asset_data->event_date) && !empty($data->event_date))
                            <h1 class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ Str::ucfirst($asset_type) }}
                                {{ __(' Date') }}
                                : <span class="text">{{ $data->event_date }}</span></h1>
                        @endif --}}


                        @if (isset($image) && !empty($image))
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $image) }}" alt="Image"
                                    class="h-40 w-40 object-cover rounded">
                            </div>
                        @endif

                        @if (isset($short_description) && !empty($short_description))
                            <h1 class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ __('Short Description') }}: </h1>
                            <p class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ $short_description }}</p>
                        @endif


                        @if (isset($description) && !empty($description))
                            <h1 class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ __('Description') }}: </h1>
                            <p class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ $description }}</p>
                        @endif

                        @if (isset($downloadurl) && !empty($downloadurl))
                            <h1 class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">{{ __(' Url') }}
                                : <a href="{{ $downloadurl }}" target="_blank" class="text text-sky-500">Click
                                    Here</a></h1>
                        @endif

                        @if (isset($event_date) && !empty($event_date))
                            <h1 class="mb-4 mt-10 mt-7 text-gray-500 text-sm ">
                                {{ __(' Event Date:') }}
                                : <span class="text">{{ $event_date }}</span></h1>
                        @endif

                        <div class="grid grid-cols-4 gap-6">
                            <div class="">
                                <div class="">
                                    <p class="mb-3 text-sm uppercase font-medium"><i
                                            class="uil-calender text-red-500 text-base"></i> {{ __('Created At') }}
                                    </p>
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
                                <h5 class="text-base text-gray-700 dark:text-gray-300 font-medium">
                                    {{ $createdBy }}
                                </h5>
                            </div>
                        </div>

                        <div class="mt-5">
                            @if ($status == STATUS_ACTIVE)
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
