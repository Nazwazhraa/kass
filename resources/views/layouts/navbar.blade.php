<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite('public/css/app.css')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script> --}}

</head>

<body>
    <div id="app" class="bg-white ">
        <div class="container bg-opacity-75  bg-white z-50" style="position: sticky; top: 0;">
            <nav class=" p-3">
                <div class="container mx-auto flex justify-between items-center">
                    <div class="flex-shrink-0">
                        <a href="/" class="text-green-800 text-xl font-bold">Keuangan.io</a>
                    </div>
                    <div class="flex items-center">
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}"
                                    class="relative inline-block btn-lg px-4 py-2 font-medium group mr-5">
                                    <span
                                        class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                    <span
                                        class="absolute inset-0 w-full h-full bg-gray-100 border-2 border-black group-hover:bg-gray-200"></span>
                                    <span class="relative text-black group-hover:text-white">Login</span>
                                </a>
                            @endif

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="relative inline-block px-4 py-2 font-medium group">
                                    <span
                                        class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                    <span
                                        class="absolute inset-0 w-full h-full bg-blue-800 border-2 border-black group-hover:bg-blue-700"></span>
                                    <span class="relative text-white group-hover:text-white">Register</span>
                                </a>
                            @endif
                        @endguest
                    </div>
                </div>
            </nav>
            <div class="border-b-2 border-gray-500"></div>
        </div>



        <main>
            @include('layouts._flash')
            @yield('content')
            <script src="/js/bootstrap.min.js"></script>
            @yield('scripts')
        </main>
    </div>
</body>

</html>
