<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chuppy | @yield('title')</title>
</head>
<body class="page-md page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo ">

    @include('layouts.header')
    @yield('css')
<div class="page-container">
    @include('layouts.sidebar')
    @yield('content')
</div>
    @include('layouts.footer')
    @yield('js')
    
</body>
</html>