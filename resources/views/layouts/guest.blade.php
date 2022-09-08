<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.favicon')

    @stack('social-meta')

    <title>{{ $pageTitle }}</title>

    <!-- Fonts -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="bg-white">
    <div class="relative overflow-hidden">
        <header class="relative">
            <div class="bg-indigo-500 py-6">
                <nav class="relative mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6"
                     aria-label="Global">
                    <div class="flex flex-1 items-center">
                        <div class="flex w-full items-center justify-between w-auto">
                            <a href="{{ route('page.home') }}">
                                <span class="sr-only">LaravelCasts</span>
                                <img class="h-8 w-auto sm:h-10"
                                     src="{{ asset('images/tv_logo.png') }}"
                                     alt="An illustrated TV as logo for LaraCasts">
                            </a>
                        </div>
                        <div class="space-x-8 ml-10 flex">
                            <a href="{{ route('page.home') }}" class="text-2xl font-medium text-white">Laravel<span
                                    class="font-bold">Casts</span></a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">

                        @guest()
                            <a class="text-base font-medium text-white hover:text-gray-300" href="{{ route('login') }}">Login</a>
                        @else
                            <a href="{{ route('page.dashboard') }}"
                               class="inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-base font-medium text-white hover:bg-gray-700">Dashboard</a>
                        @endguest
                    </div>
                </nav>
            </div>
        </header>
        {{ $slot }}

        @include('partials.footer')

    </div>
</div>

<!-- Scripts -->
@stack('scripts')

</body>
</html>
