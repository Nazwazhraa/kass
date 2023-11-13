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
    <link href="/css/sweetalert2.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    @yield('styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    @vite('public/css/app.css')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script> --}}

</head>

<body>
    <div id="app">
        <aside class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
            aria-label="Sidebar">
            <div class="h-full p-3 overflow-y-auto bg-white dark:bg-gray-800">
                <a href="/" class="flex items-center pl-2.5 mb-5">
                    <span class="self-center text-xl font-semibold text-green-800">Keuangan.io</span>
                </a>
                <ul class="space-y-2 font-medium mb-3">
                    <li>
                        <a href="/home"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <div class="w-9 h-9 bg-gray-200 rounded-full flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="m-auto w-5 h-5"
                                    style="fill: {{ Route::current()->getName() == 'home' ? '#3a3' : '#000' }}">
                                    <path
                                        d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                                </svg>
                            </div>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul class="space-y-2 font-medium mb-3">
                    <li>
                        <a href="/cashflows"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <div class="w-9 h-9 bg-gray-200 rounded-full flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="m-auto w-5 h5" viewBox="0 0 512 512"
                                    {{-- style="fill: {{ Route::current()->getName() == 'cashflows.index' ? '#3a3' : '#000' }}" --}}
                                    style="fill: {{ in_array(Route::current()->getName(), ['cashflows.index', 'cashflows.create', 'cashflows.edit', 'cashflows.show', 'categories.create', 'categories.edit', 'categories.show']) ? '#3a3' : '#000' }}">
                                    <path
                                        d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm406.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L320 210.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L240 221.3l57.4 57.4c12.5 12.5 32.8 12.5 45.3 0l128-128z" />
                                </svg>
                            </div>
                            <span class="ml-3">Cashflow</span>
                        </a>
                    </li>
                </ul>
                <ul class="space-y-2 font-medium mb-3">
                    <li>
                        <div class="dropdown inline-block relative">
                            <button
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <div class="w-9 h-9 bg-gray-200 rounded-full flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="m-auto w-5 h-5 "
                                        viewBox="0 0 640 512"
                                        style="fill: {{ in_array(Route::current()->getName(), ['users.index', 'users.create', 'users.edit', 'users.show', 'roles.index', 'roles.create', 'roles.edit', 'roles.show', 'permissions.index', 'permissions.create', 'permissions.edit', 'permissions.show']) ? '#3a3' : '#000' }}">
                                        <path
                                            d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM609.3 512H471.4c5.4-9.4 8.6-20.3 8.6-32v-8c0-60.7-27.1-115.2-69.8-151.8c2.4-.1 4.7-.2 7.1-.2h61.4C567.8 320 640 392.2 640 481.3c0 17-13.8 30.7-30.7 30.7zM432 256c-31 0-59-12.6-79.3-32.9C372.4 196.5 384 163.6 384 128c0-26.8-6.6-52.1-18.3-74.3C384.3 40.1 407.2 32 432 32c61.9 0 112 50.1 112 112s-50.1 112-112 112z" />
                                    </svg>
                                </div>
                                <span class="ml-3 mr-2">Access Control List</span>
                                <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul class="space-y-2 ml-12 dropdown-menu">
                                <li>
                                    <a href="/users"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-700 transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">User</a>
                                </li>
                                <li>
                                    <a href="/roles"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-700 transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Roles</a>
                                </li>
                                <li>
                                    <a href="/permissions"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-700 transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Permissions</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul class="space-y-2 font-medium mb-3">
                    <li>
                        <a href="javascript:logout()"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <div class="w-9 h-9 bg-gray-200 rounded-full flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="m-auto w-5 h-5" viewBox="0 0 512 512">
                                    <path
                                        d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                                </svg>
                            </div>
                            <span class="ml-3">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>

            </div>
        </aside>

        <div class="sm:ml-64">
            <main>
                <nav class="bg-white text-black p-3 ml-1 flex items-center z-40 shadow-sm"
                    style="position: sticky; top: 0;">
                    <div class="mr-auto">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                            @yield('nav-title')
                        </span>
                    </div>

                    <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                        class="tems-center text-sm font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:mr-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
                        type="button">
                        @if (auth()->user()->photo)
                            <img src="{{ asset('uploads/' . auth()->user()->photo) }}" alt="Profile Photo"
                                class="w-8 h-8 mx-auto rounded-full">
                        @else
                            <img src="{{ url('https://i.pinimg.com/originals/c6/e9/ed/c6e9ed167165ca99c4d428426e256fae.png') }}"
                                alt="Default Profile Photo" class="w-8 h-8 mx-auto rounded-full">
                        @endif
                    </button>

                    <div id="dropdownAvatarName"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-74 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white flex items-center space-x-3">
                            @if (auth()->user()->photo)
                                <img src="{{ asset('uploads/' . auth()->user()->photo) }}" alt="Profile Photo"
                                    class="w-10 h-10 mx-auto rounded-full object-cover">
                            @else
                                <img src="{{ url('https://i.pinimg.com/originals/c6/e9/ed/c6e9ed167165ca99c4d428426e256fae.png') }}"
                                    alt="Default Profile Photo" class="w-8 h-8 mx-auto rounded-full">
                            @endif
                            <div>
                                <div class="font-medium">{{ Auth::user()->name }}</div>
                                <div class="truncate">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        @if (auth()->check())
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                                <li>
                                    <a href="{{ url('profile') }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profil</a>
                                </li>
                                <li>
                                    <a href="{{ url('/settings/password') }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ubah
                                        Password</a>
                                </li>
                            </ul>
                        @endif
                    </div>


                </nav>
                <div class="bg-white mt-1 ml-1 min-h-screen p-1">
                    @include('layouts._flash')
                    @yield('content')
                </div>
            </main>
        </div>

        {{-- Buttom navigation --}}
        <div class="sm:hidden sticky bottom-0 w-full p-1 border bg-white">
            <div class="flex justify-content-evenly">
                <a href="/home" class="flex items-center p-2 text-gray-900 group">
                    <div>
                        <div class="w-8 h-8 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="m-auto w-6 h-6"
                                style="fill: {{ Route::current()->getName() == 'home' ? '#3a3' : '#000' }}">
                                <path
                                    d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="/cashflows" class="flex items-center p-2 text-gray-900 group">
                    <div>
                        <div class="w-8 h-8 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="m-auto w-6 h-6" viewBox="0 0 512 512"
                                style="fill: {{ in_array(Route::current()->getName(), ['cashflows.index', 'cashflows.create', 'cashflows.edit', 'cashflows.show', 'categories.create', 'categories.edit', 'categories.show']) ? '#3a3' : '#000' }}">
                                <path
                                    d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm406.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L320 210.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L240 221.3l57.4 57.4c12.5 12.5 32.8 12.5 45.3 0l128-128z" />
                            </svg>
                        </div>
                    </div>
                </a>

                <button id="dropdownTopButton" data-dropdown-toggle="dropdownTop" data-dropdown-placement="top"
                    type="button">
                    <div class="w-8 h-8 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="m-auto w-6 h-6" viewBox="0 0 640 512"
                            style="fill: {{ in_array(Route::current()->getName(), ['users.index', 'users.create', 'users.edit', 'users.show', 'roles.index', 'roles.create', 'roles.edit', 'roles.show', 'permissions.index', 'permissions.create', 'permissions.edit', 'permissions.show']) ? '#3a3' : '#000' }}">
                            <path
                                d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM609.3 512H471.4c5.4-9.4 8.6-20.3 8.6-32v-8c0-60.7-27.1-115.2-69.8-151.8c2.4-.1 4.7-.2 7.1-.2h61.4C567.8 320 640 392.2 640 481.3c0 17-13.8 30.7-30.7 30.7zM432 256c-31 0-59-12.6-79.3-32.9C372.4 196.5 384 163.6 384 128c0-26.8-6.6-52.1-18.3-74.3C384.3 40.1 407.2 32 432 32c61.9 0 112 50.1 112 112s-50.1 112-112 112z" />
                        </svg>
                    </div>
                </button>
                <div id="dropdownTop"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownTopButton">
                        <li>
                            <a href="/users" class="block px-4 py-2 hover:bg-gray-100">User</a>
                        </li>
                        <li>
                            <a href="/roles" class="block px-4 py-2 hover:bg-gray-100">Roles</a>
                        </li>
                        <li>
                            <a href="/permissions" class="block px-4 py-2 hover:bg-gray-100">Permissions</a>
                        </li>
                    </ul>
                </div>

                <a href="javascript:logout()" class="flex items-center p-2 text-gray-900 group">
                    <div>
                        <div class="w-8 h-8 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="m-auto w-6 h-6" viewBox="0 0 512 512">
                                <path
                                    d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/sweetalert2.min.js"></script>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script>
        async function swalConfirmMsg(title, text) {
            let status = null;
            await Swal.fire({
                icon: 'question',
                title,
                text,
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((e) => {
                status = e.isConfirmed;
            });
            return status;
        }

        function logout() {
            swalConfirmMsg(null, 'Apakah Anda ingin melakukan logout?')
                .then(e => {
                    if (e) {
                        document.getElementById('logout-form').submit();
                    }
                });
        }
    </script>
    @yield('scripts')
</body>

</html>
