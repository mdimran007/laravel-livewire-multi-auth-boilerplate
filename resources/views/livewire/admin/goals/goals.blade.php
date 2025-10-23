<div>
    <!-- Page Title Start -->
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? '' }}</h4>
        <a href="{{ route('admin.goals.create') }}" class="btn bg-success text-white">
            + {{ __('Create Goal') }}
        </a>
    </div>
    <!-- Page Title End -->

    <div class="flex flex-auto flex-col">
        @if (is_array($goals) || count($goals) > 0)
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($goals as $item)
                    <div wire:key="item-{{ $item->id }}" class="card">
                        <div class="card-header">
                            <div class="flex justify-between items-center">
                                <h5 class="card-title">
                                    {{ $item->title != null ? \Illuminate\Support\Str::limit($item->title, 34, '...') : 'N/A' }}
                                </h5>
                                @if ($item->status == STATUS_ACTIVE)
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
                        <div class="flex flex-col">
                            <div class="py-3 px-6">
                                <h5 class="my-2"><a href="apps-project-detail.html"
                                        class="text-slate-900 dark:text-slate-200">{{ __('Short Description') }}:</a>
                                </h5>
                                <p class="text-gray-500 text-sm mb-9">
                                    {{ $item->short_description != null ? \Illuminate\Support\Str::limit($item->short_description, 200, '...') : 'N/A' }}
                                </p>
                                <div class="flex -space-x-2">
                                </div>
                            </div>

                            <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                                <div class="grid lg:grid-cols-2 gap-4">
                                    <div class="flex items-center justify-between gap-2">
                                        <a href="#" class="text-sm">
                                            <i class="mgc_calendar_line text-lg me-2"></i>
                                            <span class="align-text-bottom">{{ __('Created') }}:
                                                {{ $item->created_at->diffForHumans() }}</span>
                                        </a>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.goals.details', $item->id) }}"
                                            class="btn border-info text-info hover:bg-info hover:text-white">{{ __('Details') }}</a>
                                        <a href="{{ route('admin.goals.edit', $item->id) }}"
                                            class="btn border-primary text-primary hover:bg-primary hover:text-white">{{ __('Edit') }}</a>
                                        <button type="button"
                                            class="btn border-danger text-danger hover:bg-danger hover:text-white"
                                            wire:click="$dispatch('confirm-delete', {{ $item->id }})">{{ __('Delete') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <div class="grid md:grid-cols-1 xl:grid-cols-1 gap-6">
                <div class="card flex h-80 justify-center p-8">
                    <div class="flex flex-col items-center justify-center h-64 text-gray-500">
                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-12 h-12 mb-3 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <!-- Text -->
                        <p class="text-lg font-medium">Data not found!</p>
                        <p class="text-sm text-gray-400">Try creating a new goal.</p>
                    </div>

                </div>
            </div>
        @endif

                <!-- Custom Pagination -->
        <div class="flex justify-between items-center mt-4">
            <div>
                Showing {{ $goals->firstItem() }} to {{ $goals->lastItem() }} of
                {{ $goals->total() }} results
            </div>

            <div class="flex space-x-1">
                @if ($goals->onFirstPage())
                    <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Previous</span>
                @else
                    <button wire:click="previousPage"
                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Previous</button>
                @endif

                @foreach ($goals->getUrlRange(1, $goals->lastPage()) as $page => $url)
                    <button wire:click="gotoPage({{ $page }})"
                        class="px-3 py-1 rounded {{ $page == $goals->currentPage() ? 'bg-slate-700 px-3 py-1 rounded text-white' : 'bg-gray-200 text-gray-700' }}">
                        {{ $page }}
                    </button>
                @endforeach

                @if ($goals->hasMorePages())
                    <button wire:click="nextPage"
                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next</button>
                @else
                    <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Next</span>
                @endif
            </div>
        </div>
    </div>
</div>
