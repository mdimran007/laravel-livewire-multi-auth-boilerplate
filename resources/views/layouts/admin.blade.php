<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? '-' }}</title>
    <link href="{{ asset('assets/admin') }}/css/app.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin') }}/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{ asset('assets/admin') }}/js/config.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('assets/admin') }}/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">


    {{-- <link href="{{ asset('assets/admin') }}/libs/nice-select2/css/nice-select2.css" rel="stylesheet" type="text/css"> --}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>
        .select2-container--classic .select2-selection--multiple {
            border: 1px solid #e9e8e8 !important;
        }

        .select2-container .select2-selection--multiple {
            min-height: 38px !important;
        }

        .select2-container .select2-search--inline .select2-search__field {
            margin-top: 5px !important;
        }
    </style>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @livewireStyles
</head>

<body>
    <div class="flex wrapper">
        @include('components.admin.sidebar')
        <div class="page-content">
            @include('components.admin.topbar')
            <main class="flex-grow p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
    <button data-toggle="back-to-top"
        class="fixed hidden h-10 w-10 items-center justify-center rounded-full z-10 bottom-20 end-14 p-2.5 bg-primary cursor-pointer shadow-lg text-white">
        <i class="mgc_arrow_up_line text-lg"></i>
    </button>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script src="{{ asset('assets/admin') }}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('assets/admin') }}/libs/feather-icons/feather.min.js"></script>
    <script src="{{ asset('assets/admin') }}/libs/%40frostui/tailwindcss/frostui.js"></script>
    <script src="{{ asset('assets/admin') }}/js/app.js"></script>
    <script src="{{ asset('assets/admin') }}/libs/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('assets/admin') }}/js/pages/dashboard.js"></script>
    <script src="{{ asset('assets/admin') }}/libs/sweetalert2/sweetalert2.min.js"></script>
    @livewireScripts
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('confirm-delete', (id) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'btn border-primary text-primary hover:bg-primary hover:text-white',
                        cancelButton: 'btn border-danger text-danger hover:bg-danger hover:text-white'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('delete-goal', {
                            id: id
                        });
                    }
                });
            });

            Livewire.on('goal-deleted', () => {
                Swal.fire(
                    'Deleted!',
                    'Goal has been deleted.',
                    'success'
                )
            });
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('toast', data => {
                const event = data[0]; // ✅ fix: extract the real object

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: event.icon,
                    title: event.title,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: event.icon === 'success' ? '#16a34a' : event.icon === 'error' ?
                        '#dc2626' : event.icon === 'warning' ? '#facc15' : '#3b82f6',
                    color: event.icon === 'warning' ? '#000000' : '#ffffff',
                    didOpen: toast => {
                        const titleEl = toast.querySelector('.swal2-title');
                        if (titleEl) {
                            titleEl.style.color = event.icon === 'warning' ? '#000000' :
                                '#ffffff';
                            titleEl.style.fontWeight = '600';
                        }
                    }
                });
            });
        });
    </script>

    @stack('script')

</body>

</html>
