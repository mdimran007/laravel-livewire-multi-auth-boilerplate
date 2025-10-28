<div>
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? 'Committee Members' }}</h4>
        <a href="{{ route('admin.committee.create') }}" class="btn bg-success text-white">
            + {{ __('Add Member') }}
        </a>
    </div>

    <div class="mt-6">
        <div class="card">
            <div class="relative overflow-x-auto">
                <div class="p-6">

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Picture</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Designation</th>
                                <th scope="col" class="px-6 py-3">URL</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Created At</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataList as $data)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        @if ($data->picture)
                                            <img src="{{ asset('storage/' . $data->picture) }}"
                                                alt="{{ $data->name }}" class="w-12 h-12 object-cover rounded-full">
                                        @else
                                            <div
                                                class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                                                <span class="text-gray-500">N/A</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $data->name }}
                                    </td>
                                    <td class="px-6 py-4">{{ $data->designation }}</td>
                                    <td class="px-6 py-4">
                                        @if ($data->url)
                                            <a href="{{ $data->url }}" target="_blank"
                                                class="text-blue-600 hover:underline">{{ $data->url }}</a>
                                        @else
                                            <span class="text-gray-500">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($data->status)
                                            <span class="text-green-600 font-semibold">Active</span>
                                        @else
                                            <span class="text-red-600 font-semibold">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ $data->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.committee.edit', $data->id) }}" class="me-0.5"> <i
                                                class="mgc_edit_line text-lg"></i>
                                        </a>
                                        <button wire:click="$dispatch('confirm-delete', {{ $data->id }})"
                                            class="ms-0.5"> <i class="mgc_delete_line text-xl"></i>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

</div>
