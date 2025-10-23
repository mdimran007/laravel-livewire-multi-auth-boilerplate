<div>
    <!-- Page Title Start -->
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? '' }}</h4>

    </div>
    <!-- Page Title End -->
    <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6 mb-6">
        <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="w-12 h-12 flex justify-center items-center rounded text-primary bg-primary/25">
                                <i class="mgc_building_2_line text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h5 class="mb-1">{{ __("Active Goals") }}</h5>
                            <p>{{ $total_goals }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="w-12 h-12 flex justify-center items-center rounded text-success bg-success/25">
                                <i class="mgc_document_line text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h5 class="mb-1">{{ __("Active Policy") }}</h5>
                            <p>{{ $total_policies }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="w-12 h-12 flex justify-center items-center rounded text-info bg-info/25">
                                <i class="mgc_server_line text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h5 class="mb-1">{{ __("Active Services") }}</h5>
                            <p>{{ $total_services }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="w-12 h-12 flex justify-center items-center rounded text-warning bg-warning/25">
                                <i class="mgc_calendar_line text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h5 class="mb-1">{{ __("Active Program") }}</h5>
                            <p>{{ $total_programmes }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
               <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="w-12 h-12 flex justify-center items-center rounded text-primary bg-primary/25">
                                <i class="mgc_building_2_line text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h5 class="mb-1">{{ __("Active Facilities") }}</h5>
                            <p>{{ $total_facilities }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="w-12 h-12 flex justify-center items-center rounded text-success bg-success/25">
                                <i class="mgc_clock_2_line text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h5 class="mb-1">{{ __("Active Events") }}</h5>
                            <p>{{ $total_events }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="w-12 h-12 flex justify-center items-center rounded text-info bg-info/25">
                                <i class="mgc_search_line text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h5 class="mb-1">{{ __("Active Research") }}</h5>
                            <p>{{ $total_research }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="w-12 h-12 flex justify-center items-center rounded text-warning bg-warning/25">
                                <i class="mgc_report_line text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h5 class="mb-1">{{ __("Active Report") }}</h5>
                            <p>{{ $total_reports }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
               <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="w-12 h-12 flex justify-center items-center rounded text-info bg-info/25">
                                <i class="mgc_news_line text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h5 class="mb-1">{{ __("Active News") }}</h5>
                            <p>{{ $total_news }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="w-12 h-12 flex justify-center items-center rounded text-warning bg-warning/25">
                                <i class="mgc_user_5_line text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h5 class="mb-1">{{ __("Active Partnerships") }}</h5>
                            <p>{{ $total_partnerships }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
