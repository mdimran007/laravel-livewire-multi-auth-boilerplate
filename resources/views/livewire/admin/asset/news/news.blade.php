<div>
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? 'News' }}</h4>
        <a href="{{ route('admin.news.create') }}" class="btn bg-success text-white">
            + {{ __('Add New') }}
        </a>
    </div>

    <div class="mt-6">
        <div class="card">
            <div class="relative overflow-x-auto">
                <!-- News Table Goes Here -->
            </div>
        </div>
    </div>
</div>
