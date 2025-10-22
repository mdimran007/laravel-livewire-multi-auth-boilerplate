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

    {{-- <link href="{{ asset('assets/admin') }}/libs/nice-select2/css/nice-select2.css" rel="stylesheet" type="text/css"> --}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>
        <style>.toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #1f2937;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 9999;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

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
    <!-- jQuery (required) -->

    <!-- Summernote CSS & JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script src="{{ asset('assets/admin') }}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('assets/admin') }}/libs/feather-icons/feather.min.js"></script>
    <script src="{{ asset('assets/admin') }}/libs/%40frostui/tailwindcss/frostui.js"></script>
    <script src="{{ asset('assets/admin') }}/js/app.js"></script>
    <script src="{{ asset('assets/admin') }}/libs/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('assets/admin') }}/js/pages/dashboard.js"></script>
    {{-- <script src="{{ asset('assets/admin') }}/libs/nice-select2/js/nice-select2.js"></script> --}}
    <!-- Choices Demo js -->
    {{-- <script src="{{ asset('assets/admin') }}/js/pages/form-select.js"></script>    --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
    </script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('toast', event => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: event.icon,
                    title: event.title,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: event.icon === 'success' ? '#16a34a' : (event.icon === 'error' ?
                        '#dc2626' : '#facc15'), // Tailwind green-600, red-600, yellow-400
                    color: '#ffffff', // text color
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Write something...',
                tabsize: 2,
                height: 200,
                // toolbar: [
                //     ['style', ['bold', 'italic', 'underline', 'clear']],
                //     ['font', ['strikethrough', 'superscript', 'subscript']],
                //     ['insert', ['link', 'picture', 'video']],
                //     ['para', ['ul', 'ol', 'paragraph']],
                //     ['view', ['fullscreen', 'codeview', 'help']]
                // ],
                // Optional: make it match Tailwind dark mode
                callbacks: {
                    onInit: function() {
                        $('.note-editor').addClass(
                            'rounded-lg border border-gray-300 dark:border-slate-600 dark:bg-slate-800'
                        );
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: 'Select an option',
                theme: "classic"
            });
        });
    </script>


    @stack('script')



</body>

</html>
