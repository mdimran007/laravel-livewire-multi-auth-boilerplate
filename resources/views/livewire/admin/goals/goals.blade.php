<div>
                   <!-- Page Title Start -->
                <div class="flex items-center justify-between mb-6">
                    <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? '' }}</h4>
                    <a href="{{ route('admin.goals.create') }}"
                        class="btn bg-success text-white" wire:navigate>
                        + {{ __("Create Goal") }}
                    </a>
                </div>
                <!-- Page Title End -->

                <div class="flex flex-auto flex-col">

                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="flex justify-between items-center">
                                    <h5 class="card-title">Web Design</h5>
                                    <div class="bg-success text-xs text-white rounded-md py-1 px-1.5 font-medium" role="alert">
                                        <span>Active</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class="py-3 px-6">
                                    <h5 class="my-2"><a href="apps-project-detail.html" class="text-slate-900 dark:text-slate-200">Landing page Design</a></h5>
                                    <p class="text-gray-500 text-sm mb-9">If several languages coalesce, the grammar of the resulting language is more regular.</p>

                                    <div class="flex -space-x-2">

                                    </div>
                                </div>

                                <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                                    <div class="grid lg:grid-cols-2 gap-4">
                                        <div class="flex items-center justify-between gap-2">
                                            <a href="#" class="text-sm">
                                                <i class="mgc_calendar_line text-lg me-2"></i>
                                                <span class="align-text-bottom">15 Dec</span>
                                            </a>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn border-info text-info hover:bg-info hover:text-white">Details</button>
                                            <button type="button" class="btn border-primary text-primary hover:bg-primary hover:text-white">Edit</button>
                                            <button type="button" class="btn border-danger text-danger hover:bg-danger hover:text-white">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="card">
                            <div class="card-header">
                                <div class="flex justify-between items-center">
                                    <h5 class="card-title">Web Design</h5>
                                     <div class="bg-warning/60 text-xs text-white rounded-md py-1 px-1.5 font-medium" role="alert">
                                        <span>Pending</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class="py-3 px-6">
                                    <h5 class="my-2"><a href="apps-project-detail.html" class="text-slate-900 dark:text-slate-200">Landing page Design</a></h5>
                                    <p class="text-gray-500 text-sm mb-9">If several languages coalesce, the grammar of the resulting language is more regular.</p>

                                    <div class="flex -space-x-2">

                                    </div>
                                </div>

                                <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                                    <div class="grid lg:grid-cols-2 gap-4">
                                        <div class="flex items-center justify-between gap-2">
                                            <a href="#" class="text-sm">
                                                <i class="mgc_calendar_line text-lg me-2"></i>
                                                <span class="align-text-bottom">15 Dec</span>
                                            </a>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn border-info text-info hover:bg-info hover:text-white">Details</button>
                                            <button type="button" class="btn border-primary text-primary hover:bg-primary hover:text-white">Edit</button>
                                            <button type="button" class="btn border-danger text-danger hover:bg-danger hover:text-white">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="card">
                            <div class="card-header">
                                <div class="flex justify-between items-center">
                                    <h5 class="card-title">Web Design</h5>
                                    <div class="bg-success text-xs text-white rounded-md py-1 px-1.5 font-medium" role="alert">
                                        <span>Active</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class="py-3 px-6">
                                    <h5 class="my-2"><a href="apps-project-detail.html" class="text-slate-900 dark:text-slate-200">Landing page Design</a></h5>
                                    <p class="text-gray-500 text-sm mb-9">If several languages coalesce, the grammar of the resulting language is more regular.</p>

                                    <div class="flex -space-x-2">

                                    </div>
                                </div>

                                <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                                    <div class="grid lg:grid-cols-2 gap-4">
                                        <div class="flex items-center justify-between gap-2">
                                            <a href="#" class="text-sm">
                                                <i class="mgc_calendar_line text-lg me-2"></i>
                                                <span class="align-text-bottom">15 Dec</span>
                                            </a>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn border-info text-info hover:bg-info hover:text-white">Details</button>
                                            <button type="button" class="btn border-primary text-primary hover:bg-primary hover:text-white">Edit</button>
                                            <button type="button" class="btn border-danger text-danger hover:bg-danger hover:text-white">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="text-center mt-6">
                        <button type="button" class="btn bg-transparent border-gray-300 dark:border-gray-700">
                            <i class="mgc_loading_4_line me-2 animate-spin"></i>
                            <span>Load More</span>
                        </button>
                    </div> --}}

                </div>
</div>
