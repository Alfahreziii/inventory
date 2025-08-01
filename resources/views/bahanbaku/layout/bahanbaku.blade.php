<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://unpkg.com/feather-icons"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


        <title>Laravel</title>
        <!-- Styles -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        @vite('resources/css/app.css', 'resources/js/app.js')
    </head>
    <body class="bg-yellow-500">
    <div class="w-full mx-auto">
        <nav class="navbars">
            <div class="w-full h-[4.6rem] relative cursor-pointer z-10">
                <ul class="m-0 p-0 list-style-none h-full flex flex-row">
                    <li class="w-full my-3">
                        <a href="#">
                            <div class="h-auto w-full flex items-center justify-center">
                                <img class="block -mt-[12px] w-full" src="{{ asset('assets/img/logo.jpeg') }}" alt="">
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="navbar-main bg-[#035233] py-4">
                <ul class="p-[10px] max-h-[100vh] overflow-auto mt-10 m-0 navigation-ul">
                    <li class="relative whitespace-nowrap m-0">
                        <a href="{{ route('dashboard') }}" class="nav-item {{ set_active(['dashboard']) }} flex items-center overflow-hidden px-4 py-[9px] my-3 text-ellipsis">
                            <i data-feather="home" class="w-[20px]"></i><span class="ml-[15px] text-base font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li class="relative whitespace-nowrap m-0">
                        <a href="{{ route('bahanbaku') }}" class="nav-item {{ set_active(['bahanbaku']) }} flex items-center overflow-hidden px-4 py-[9px] my-3 text-ellipsis">
                            <i data-feather="copy" class="w-[20px]"></i><span class="ml-[15px] text-base font-medium">Bahan Baku</span>
                        </a>
                    </li>
                    <li class="relative whitespace-nowrap m-0">
                        <a href="{{ route('namabahan') }}" class="nav-item {{ set_active(['namabahan']) }} flex items-center overflow-hidden px-4 py-[9px] my-3 text-ellipsis">
                            <i data-feather="archive" class="w-[20px]"></i><span class="ml-[15px] text-base font-medium">Nama Bahan</span>
                        </a>
                    </li>
                    <li class="relative whitespace-nowrap m-0">
                        <a href="{{ route('eoq') }}" class="nav-item {{ set_active(['eoq']) }} flex items-center overflow-hidden px-4 py-[9px] my-3 text-ellipsis">
                            <i data-feather="cpu" class="w-[20px]"></i><span class="ml-[15px] text-base font-medium">EOQ</span>
                        </a>
                    </li>
                    <li class="relative whitespace-nowrap m-0">
                        <a href="{{ route('riwayat-pengeluaran') }}" class="nav-item {{ set_active(['riwayat-pengeluaran']) }} flex items-center overflow-hidden px-4 py-[9px] my-3 text-ellipsis">
                            <i data-feather="airplay" class="w-[20px]"></i><span class="ml-[15px] text-base font-medium">Riwayat Pengeluaran</span>
                        </a>
                    </li>
                    <li class="relative whitespace-nowrap m-0">
                        <a href="{{ route('user') }}" class="nav-item {{ set_active(['user']) }} flex items-center overflow-hidden px-4 py-[9px] my-3 text-ellipsis">
                            <i data-feather="book-open" class="w-[20px]"></i><span class="ml-[15px] text-base font-medium">Riwayat Login</span>
                        </a>
                    </li>
                    <li class="relative whitespace-nowrap m-0">
                        <a href="{{ route('role') }}" class="nav-item {{ set_active(['role']) }} flex items-center overflow-hidden px-4 py-[9px] my-3 text-ellipsis">
                            <i data-feather="book-open" class="w-[20px]"></i><span class="ml-[15px] text-base font-medium">Role Management</span>
                        </a>
                    </li>
                </ul>
                <ul class="mt-16">
                    <form method="POST" action="{{ route('logout') }}" class="relative whitespace-nowrap m-0 mt-auto">
                        @csrf
                        <button type="submit" class="nav-item flex items-center overflow-hidden px-4 py-[9px] my-3 text-ellipsis">
                            <i data-feather="log-out" class="w-[25px] text-red-400 icon-arrow font-[800]"></i><span class="ml-[15px] text-lg font-bold text-red-400">Logout</span>
                        </button>
                    </form>
                </ul>
            </div>

        </nav>
        <section class="content app">
            <div class="wrapper-dashboard px-3 max-w-[1150px] mx-auto min-h-[90vh]">
                <div class="content-dashbord mx-[15px] p7">
{{-- top-navbar --}}
<div class="my-5" x-data="{ open: false }">
    <div class="w-full">
        <div class="">
            <div class="flex items-center max-[500px]:flex-wrap">
                <div class="mr-auto float-left items-center flex w-full">
                    <p class="text-[#035233] font-semibold text-lg">{{ $top->name }}</p>
                </div>
                <div class=" flex w-full">
                    <div class="ml-auto flex justify-center items-center">
                        <i data-feather="menu" class="hamburger mr-4 text-[#035233] cursor-pointer" id="hamburger"></i>
                        <i data-feather="bell" class="text-[#035233] font-bold"></i>
                    </div>
                    <div class="wrapper-user">
                        <div class="flex flex-col items-end mr-[0.8rem]">
                            <span class="user text-white text-base text-right"></span>
                            <span class="text-white text-sm text-right"></span>
                        </div>
                        <li class="relative flex items-center w-[45px] max-[400px]:w-[50px]">
                            <div class="block p-0 transition-all text-sm ease-nav-brand">
                                <span class="flex justify-center items-center">
                                    <i data-feather="user" class="text-[#035233] font-bold cursor-pointer" onclick="toggleMenu()"></i>
                                </span>
                            </div>
                            <div class="sub-menu-wrap z-50" id="subMenu">
                                <div class="sub-menu rounded shadow xl">
                                    <div class="user-info">
                                        <i data-feather="user" class="w-[20px] icon-arrow"></i><span class="ml-[15px] text-sm judul"><a href="{{ route('profile.edit') }}">Profile</a></span><span class="font-extrabold ml-auto">></span>
                                    </div>
                                    <div class="user-info mt-3">
                                        <i data-feather="log-out" class="w-[20px] icon-arrow"></i><span class="ml-[15px] text-sm judul">
                                            <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit">Logout</button>
                                            </form>
                                        </span><span class="font-extrabold ml-auto">></span>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end top-navbar --}}

                    {{-- main-content --}}
                    @yield('content_bahanbaku')
                    {{-- end main-content --}}

                </div>
            </div>
        </section>
    </div>


        <footer class="ml-[260px] footer-index py-4 px-[2.2rem] h-[8vh] bg-white shadow bottom-0 relative">
            <p class="clearfix mb-0 flex items-center w-full h-full">
                <span class="text-[#727E8C] text-right ml-auto float-right inline-block text-base font-normal">2024 © <a href="#">Alfahrezi</a></span>
            </p>
        </footer>

        <script>
          feather.replace();
        </script>
            <script src="{{ asset('assets/js/main-js.js') }}"></script>
    </body>
</html>
