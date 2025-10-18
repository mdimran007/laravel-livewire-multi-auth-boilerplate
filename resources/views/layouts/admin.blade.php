<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '-' }}</title>
    <link href="{{asset('assets/admin')}}/css/app.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin')}}/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{asset('assets/admin')}}/js/config.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    @livewireScripts
</body>
</html>