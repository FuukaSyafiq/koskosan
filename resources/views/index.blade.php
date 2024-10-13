<x-header :user="$user" />
@php
    //  print_r($rooms);
@endphp

<div class="min-h-screen flex flex-col">
    <main
        class="h-screen my-5 lg:justify-around justify-center w-full items-center flex bg-green-500 text-white flex-col lg:flex-row">
        <div class="w-full flex flex-col lg:flex-row items-center lg:justify-start justify-center" data-aos="fade-right">
            <div class="m-5 md:m-20 p-4">
                <ol class="mb-3">
                    <!-- List content -->
                </ol>
            </div>
            <div class="mr-5 text-center lg:text-left">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold break-words" data-aos="fade-right">
                    Welcome To Kosloka
                </h1>
                <p class="my-5 text-lg sm:text-xl md:text-2xl font-bolder font-poppins break-words"
                    data-aos="fade-right">
                    Solusi Kos Ideal Anda.
                </p>
            </div>
        </div>
        {{-- <div data-aos="fade-left" class="w-full lg:w-1/2 mr-3 block hidden lg:block">
           <img src="https://placehold.co/500x500" class="rounded-lg w-full" alt="profileku" />
        </div> --}}
    </main>
    {{-- <div class="flex-grow flex items-center justify-center">
        <h1 class="text-4xl font-bold text-center">Selamat datang di KosLoka</h1>
    </div> --}}
    <div class="flex-grow w-full flex h-screen justify-center items-center">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
            @foreach ($rooms as $item)
                <x-tiperoom :data="$item" />
            @endforeach
        </div>
    </div>
    <div class="flex w-full justify-around items-center h-screen bg-green-500 text-xl">
        <div class="w-1/3 text-white font-bold">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium doloribus deserunt iusto maiores rem
            perferendis voluptate! Nisi exercitationem dolorum autem reiciendis ut accusantium eligendi deleniti
            placeat. Velit repellat accusantium sunt!
        </div>
        <div class="w-1/3 text-white font-bold">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium doloribus deserunt iusto maiores rem
            perferendis voluptate! Nisi exercitationem dolorum autem reiciendis ut accusantium eligendi deleniti
            placeat. Velit repellat accusantium sunt!
        </div>
    </div>
    <div class="flex w-full justify-center items-center h-screen text-2xl">
        <p class="text-black w-3/5 mx-auto font-bold text-center">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum, ab a, sequi harum dolorem atque quam officiis eveniet aperiam beatae libero nemo eligendi culpa error nostrum dolor adipisci eos. Minus necessitatibus error facilis provident enim, deleniti ea quibusdam officiis cumque!
        </p>
    </div>
    <x-footer />
</div>
