<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? '-' }}</title>
    <link href="{{asset('assets/admin')}}/css/app.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin')}}/css/icons.min.css" rel="stylesheet" type="text/css">
    
       <!-- quill css -->
    <link href="{{asset('assets/admin')}}/libs/quill/quill.core.css" rel="stylesheet" type="text/css" >
    <link href="{{asset('assets/admin')}}/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" >
    <link href="{{asset('assets/admin')}}/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" >

    <script src="{{asset('assets/admin')}}/js/config.js"></script>
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
    <button data-toggle="back-to-top" class="fixed hidden h-10 w-10 items-center justify-center rounded-full z-10 bottom-20 end-14 p-2.5 bg-primary cursor-pointer shadow-lg text-white">
        <i class="mgc_arrow_up_line text-lg"></i>
    </button>
    <script src="{{asset('assets/admin')}}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('assets/admin')}}/libs/feather-icons/feather.min.js"></script>
    <script src="{{asset('assets/admin')}}/libs/%40frostui/tailwindcss/frostui.js"></script>
    <script src="{{asset('assets/admin')}}/js/app.js"></script>
    <script src="{{asset('assets/admin')}}/libs/apexcharts/apexcharts.min.js"></script>
    <script src="{{asset('assets/admin')}}/js/pages/dashboard.js"></script>
    <script src="{{asset('assets/admin')}}/libs/quill/quill.min.js"></script>
    <script src="{{asset('assets/admin')}}/js/pages/form-editor.js"></script>
    @livewireScripts

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    Livewire.dispatch('delete-goal', { id: id });
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


</body>
</html>