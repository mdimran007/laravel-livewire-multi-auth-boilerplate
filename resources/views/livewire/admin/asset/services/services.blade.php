<div>
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? 'Services' }}</h4>
        <a href="{{ route('admin.services.create') }}" class="btn bg-success text-white">
            + {{ __('Add New') }}
        </a>
    </div>

    <div class="mt-6">
        <div class="card">
            <div class="relative overflow-x-auto">
                <!-- Services Table Goes Here -->
            </div>
        </div>
    </div>
</div>
