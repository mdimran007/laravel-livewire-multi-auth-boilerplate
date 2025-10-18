<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '-' }}</title>
    <link href="{{asset('assets/admin')}}/css/app.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin')}}/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{asset('assets/admin')}}/js/config.js"></script>
</head>
<body>
     {{ $slot }}
</body>
</html>