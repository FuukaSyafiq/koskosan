<x-header />

@php
    use App\Models\RentedRoom;
    use Carbon\Carbon;

    $user = auth()->check();

    if ($user) {
        $rentedRoom = RentedRoom::where('room_id', $room[0]['id'])
            ->where('user_id', auth()->user()->id)
            ->first();
    }

    // // print_r($review);
    // $vrImage = collect($room)->firstWhere('is_vr', true);

    // // Jika tidak ada gambar VR, ambil gambar pertama sebagai fallback
    // $imagePath = $vrImage ? $vrImage['path'] : $room[0]['path'];

@endphp

@if (count($room) > 0)
    <div class="container mx-auto px-4 py-8">
        <a href="/roomlist" class="inline-block mb-6 font-bold text-blue-600 hover:text-blue-800 transition-colors">
            &larr; Back
        </a>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Image Container -->
            <div class="w-full lg:w-1/2">
                @if (isset($room[0]['path']))
                    <div class="rounded-lg overflow-hidden shadow-lg">
                        <img src="{{ $room[0]['path']}}" class="w-full h-auto object-cover" alt="{{ $room[0]['name'] }}" />
                    </div>
                @endif
            </div>

            <!-- Room Details -->
            <div class="w-full lg:w-1/2 space-y-6">
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        {{ $room[0]['name'] }}
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tipe: {{ $tipeRoom }}</p>
                </div>

                <div class="flex items-center justify-center lg:justify-start space-x-2">
                    @if ($avgRating->avg_star == 0)
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                            Belum ada review
                        </span>
                    @else
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                            {{ number_format($avgRating->avg_star, 1) }}
                        </span>
                        <div class="flex items-center">
                            @for ($i = 1; $i <= $avgRating->avg_star; $i++)
                                <x-star />
                            @endfor
                        </div>
                    @endif
                </div>

                <h2 class="font-bold text-2xl text-center lg:text-left text-green-600">
                    Rp. {{ number_format($price, 0, ',', '.') }}/Bulan
                </h2>

                <hr class="w-full h-0.5 bg-gray-300" />

                <div class="space-y-4">
                    <div>
                        <h3 class="font-semibold text-lg">Description</h3>
                        <p class="text-gray-600">{{ $room[0]['description'] }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg">Fasilitas</h3>
                        <p class="text-gray-600">{{ $facility }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="w-11/12 mx-auto my-10">
        <h3 class="font-semibold text-lg text-center">Reviews</h3>
        <div class="space-y-4">
            @if (isset($rentedRoom))
                <form action="/rating/room/{{ $room[0]['id'] }}?userid={{ auth()->user()->id ?? null }}" method="POST">
                    @csrf
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Give
                        Review</label>
                    {{-- <x-star-input /> --}}
                    <div class="flex flex-col w-1/5">
                        <label for="star">Star :</label>
                        <input type="number" placeholder="5" id="star" name="star" max="5"
                            class="my-2 rounded-md" />
                    </div>
                    <textarea id="message" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your reviews here..." name="review"></textarea>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 mt-4 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Send</button>
                </form>
            @endif
            @if (!isset($review[0]))
                <div class="border p-4 flex justify-center items-center rounded-md shadow-sm">
                    <h1 class="font-bold text-2xl my-5">Tidak ada review</h1>
                </div>
            @endif
            @foreach ($review as $item)
                @if (isset($item->review))
                    <figure class="w-full shadow-lg p-5">
                        <div class="flex items-center mb-4 text-yellow-300">
                            @for ($i = 1; $i <= $item->star; $i++)
                                <x-star />
                            @endfor
                        </div>
                        <blockquote>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $item->review }}</p>
                        </blockquote>
                        <figcaption class="flex items-center mt-6 space-x-3 rtl:space-x-reverse">
                            <img class="w-6 h-6 rounded-full" src="https://placehold.co/100x100" alt="profile picture">
                            <div
                                class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-300 dark:divide-gray-700">
                                <cite class="pe-3 font-medium text-gray-900 dark:text-white">{{ $item->name }}</cite>
                            </div>
                        </figcaption>
                        <cite
                            class="pe-3 mt-3 font-medium text-gray-900 dark:text-white">{{ Carbon::parse($item->created_at)->translatedFormat('l, j F Y') }}</cite>
                    </figure>
                @endif
            @endforeach
        </div>
    </div>
@else
    <h1 class="font-bold text-3xl text-center flex w-full h-screen justify-center items-center">Room Tidak Ditemukan
    </h1>
@endif
