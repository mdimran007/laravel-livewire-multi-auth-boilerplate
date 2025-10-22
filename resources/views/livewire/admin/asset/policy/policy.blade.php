<div>
    <!-- Page Title Start -->
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? 'Policy' }}</h4>
        <a href="{{ route('admin.policy.create') }}" class="btn bg-success text-white">
            + {{ __('Add New') }}
        </a>
    </div>
    <!-- Page Title End -->

    <div class="mt-6">
        <div class="card">
            <div class="relative overflow-x-auto">
                <!-- Policy Table Goes Here -->
            </div>
        </div>
    </div>
</div>
