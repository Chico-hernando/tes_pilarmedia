<!DOCTYPE html>
<html>
<head>
    <title>Register Absensi</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href=" {{ mix('css/app.css') }}" rel="stylesheet" >
    <link rel="stylesheet" href="{{ asset('css')}}/custom.css">
    <link rel="stylesheet" href="{{ asset('css')}}/customlagi.css">
    <link rel="icon" href="{{ URL::asset('/image/img.png') }}" type="image/x-icon" />
</head>
<body class="bg-gradient-teal">
<div class="main-content">
    @yield('content')
</div>
<script src="{{ asset('js') }}/custom.js"></script>
<script src="{{ asset('js') }}/app.js"></script>
</body>
</html>
