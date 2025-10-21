<div>
    <!-- Page Title Start -->
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $pageTitle ?? '' }}</h4>
        <button wire:click="" class="btn bg-success text-white">
            + {{ __('Create User') }}
        </button>
    </div>
    <!-- Page Title End -->

    <div class="mt-6">
        <div class="card">

            <div class="relative overflow-x-auto">
                <table class="w-full divide-y divide-gray-300 dark:divide-gray-700">
                    <thead
                        class="bg-slate-300 bg-opacity-20 border-t dark:bg-slate-800 divide-gray-300 dark:border-gray-700">
                        <tr>
                            <th scope="col"
                                class="py-3.5 ps-4 pe-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Picture</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Name</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Email</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Phone</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Status</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Created Date</th>
                            <th scope="col"
                                class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 ">
                        <tr>
                            <td
                                class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="assets/images/users/avatar-9.jpg"
                                        alt="">
                                </div>
                            </td>
                            <td class="whitespace-nowrap py-4 pe-3 text-sm">
                                <div class="flex items-center">
                                    <div class="font-medium text-gray-900 dark:text-gray-200 ms-4">Lindsay Walton</div>
                                </div>
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                test@gmail.com</td>
                           
                                      <td
                                class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                01763732521</td>
                           
                            
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div
                                    class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-dark/80 text-white">
                                    Closed</div>
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
                                13/08/2011</td>

                            <td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
                                <a href="javascript:void(0);" class="me-0.5"> <i class="mgc_edit_line text-lg"></i> </a>
                                <a href="javascript:void(0);" class="ms-0.5"> <i class="mgc_delete_line text-xl"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
