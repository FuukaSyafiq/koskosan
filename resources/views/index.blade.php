<x-header :user="$user" />
@php
//  print_r($rooms);   
@endphp

<div class="min-h-screen flex flex-col">
    <main class="h-screen my-5 lg:justify-around justify-center w-full items-center flex bg-green-500 text-white">
        <div class="w-full items-center lg:justify-start justify-center flex" data-aos="fade-right">
            <div class="m-20  p-4">
                <ol class="mb-3">

                </ol>
            </div>
            <div class="mr-5">
                <h1 class="text-4xl font-bold" data-aos="fade-right">
                    Welcome To Kosloka
                </h1>
                <p class="my-5 text-2xl tablet:text-xl text-md font-bolder font-poppins sm:text-md"
                    data-aos="fade-right">
                    Lorem, ipsum dolor.
                </p>
                <Link to="/services"
                    class="shadow-4xl font-semibold bg-gray-200 text-purple-900 py-3  px-6 rounded-xl text-lg "
                    data-aos="fade-down">
                Service
                </Link>
            </div>
        </div>
        <div data-aos="fade-left" class="w-1/2 block ">
            <img src="https://placehold.co/500x500" class="rounded-lg w-4/4" alt="profileku" />
        </div>
    </main>
    {{-- <div class="flex-grow flex items-center justify-center">
        <h1 class="text-4xl font-bold text-center">Selamat datang di KosLoka</h1>
    </div> --}}
    <div class="flex-grow w-full flex justify-center items-center">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
            @foreach ($rooms as $item)
                <x-tiperoom :data="$item" />
            @endforeach
        </div>
    </div>
    <x-footer />
</div>
