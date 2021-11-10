<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Absensi</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href=" {{ mix('css/app.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css')}}/custom.css">
    <link rel="stylesheet" href="{{ asset('css')}}/customlagi.css">
    <link rel="stylesheet" href="{{ asset('css')}}/dataTableCustom.css">

    <link rel="icon" href="{{ URL::asset('/image/img.png') }}" type="image/x-icon" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js">

</head>
<body onload="startTime()">
@if(isset($user))
    @include('base.sidebar')
@endif
<div class="main-content">
    @yield('content')
</div>
<script src="{{ asset('js') }}/custom.js"></script>
<script src="{{ asset('js') }}/app.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>
