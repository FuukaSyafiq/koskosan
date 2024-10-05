@props(['user' => auth()->user()])
@vite('resources/css/app.css')
@vite('resources/js/app.js')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KosLoka</title>
    @vite('resources/css/app.css')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="https://tenor.com/id/view/black-hot-mafia-kardiya-gif-25072254" type="image/png" />
    <style>
    </style>
</head>
<!--
^STYLING USAGE
|comment the current background:linear-gradient
|uncomment the other background:linear-gradient
|choose one that you think look's good
|NOTE:only one linear-gradient can be applied at a time!!
-->

<style>
    body {
        background: #EEEEEE;
    }

    /* remove 'input type number' arrow*/
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        display: none;
        margin: 0;
    }
</style>

<nav class="w-full mt-2 border-gray-200 dark:bg-gray-900 rounded-md text-white">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
        <a href="{{ route('index') }}" class="flex w-1/5 items-center">
            {{-- <img src="/assets/images/sipraja.webp" class="h-10" alt="Sipraja Logo" /> --}}
            <span class="self-center text-2xl text-lime-600 font-semibold whitespace-nowrap">KosLoka</span>
        </a>

        <form class="w-2/5 mx-auto" action="/kos">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="location"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari daerah kosmu" required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    onclick="">Search</button>
            </div>
        </form>

        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm  rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto justify-end" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                @if ($user)
                    @if ($user->role_id == \App\Models\Role::getIdByRole('PENYEWA'))
                    <li>
                        <a href="{{ url('/penyewa') }}"
                            class="block mt-2 px-3 font-bold bg-slate-700 rounded md:bg-transparent  md:p-0 dark:text-white md:dark:text-slate-500"
                            aria-current="page">Kamar Anda</a>
                    </li>
                    @endif

                    @if ($user->role_id == \App\Models\Role::getIdByRole('OWNER'))
                        <li>
                            <a href="{{ url('/owner') }}"
                                class="block mt-2 px-3 font-bold bg-slate-700 rounded md:bg-transparent  md:p-0 dark:text-white md:dark:text-slate-500"
                                aria-current="page">Kelola KOS</a>
                        </li>
                        <li>
                            <a href="{{ url('/dashboard/permissionManager/pmrole') }}"
                                class="block mt-2 px-3 font-bold bg-slate-700 rounded md:bg-transparent  md:p-0 dark:text-white md:dark:text-slate-500"
                                aria-current="page">Permission manager</a>
                        </li>
                    @endif

                    <!-- user profile start -->
                    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                        <button type="button"
                            class="flex text-sm bg-white rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 border-solid border-2 border-gray-950"
                            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                            data-dropdown-placement="bottom">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="/assets/images/profile.svg" alt="user photo">
                        </button>
                        <!-- Dropdown menu -->
                        <div class="bg-amber-100 z-50 hidden my-4 text-base list-none    divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="user-dropdown">
                            <div class="px-4 py-3">
                                <span
                                    class="block text-md text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                                <span
                                    class="block text-md  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                            </div>
                            <ul class="py-2" aria-labelledby="user-menu-button">
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                            onclick="event.preventDefault();                                                                                                                                         this.closest('form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- user profile end -->
                @elseif (!$user)
                    <li>
                        <a href="{{url("/denah")}}">
                            <button id="dropdownDefaultButton"
                                class="text-white bg-lime-400 hover:bg-lime-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">Denah
                            </button>
                        </a>

                    </li>
                    <li>

                        <a href="{{ route('login') }}">
                            <button id="dropdownDefaultButton"
                                class="text-white bg-lime-400 hover:bg-lime-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">Login
                            </button>
                        </a>

                    </li>
                    <li>
                        <a href="{{ url('/register') }}">
                            <button type="button"
                                class="text-white bg-lime-400 hover:bg-lime-500 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</button>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
