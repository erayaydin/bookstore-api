<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('dist/images/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('page.description')">
    <meta name="keywords" content="@yield('page.keywords')">
    <meta name="author" content="Eray Aydın">
    <title>@yield('page.title', config('app.name'))</title>

    <!-- Plugin styles -->
    @stack('plugin.styles')

    <!-- Page styles -->
    @stack('page.styles')

    @livewireStyles
</head>
<body class="@yield('body.class', 'app')">
@yield('body')

<!-- Plugin scripts -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.min.js" defer></script>
@stack('plugin.scripts')

<!-- Page scripts -->
@stack('page.scripts')

@livewireScripts
</body>
</html>
