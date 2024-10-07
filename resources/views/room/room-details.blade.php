<x-header />

@php
    // require_once app_path();
    use App\Helpers\CalculateRating;

@endphp

<div class="flex w-11/12 mx-auto justify-center items-center">
    <div class="flex flex-col mt-10 w-1/3 space-y-4">
        <!-- Main Image Container -->
        <div class="rounded-md overflow-hidden">
            <img src="{{ $data[0]['path'] }}" class="object-cover w-full h-80" alt="image" />
        </div>

        <!-- Thumbnail Images -->
        <div class="flex justify-center gap-3">
            @foreach ($data as $key => $val)
                <img src="{{ $data[$key]['path'] }}"
                    class="w-[90px] h-[90px] flex flex-wrap gap-1 justify-between rounded-md" alt="thumbnail" />
            @endforeach
        </div>

        <button type="button"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">SEWA</button>
    </div>

    <!-- Room Details -->
    <div class="flex flex-col justify-center w-1/3 mt-5">
        <h1 class="font-bold text-5xl text-center">{{ $data[0]['name'] }}</h1>

        <h2 class="font-bold text-2xl text-center">
            Rp. {{ number_format($data[0]['price'], 0, ',', '.') }}/Bulan
        </h2>
        <span class="text-gray-500">

            <div class="flex">
                @for ($i = 1; $i <= $data[0]['star']; $i++)
                    <x-star />
                @endfor
            </div>
            {{-- @foreach ($data as $key => $item)
            
                {{ calculateRating($data[$key]['star']) }}
            @endforeach () --}} Rating
        </span>

        <p class="mt-3 text-lg text-center text-gray-700">Description</p>
        <p class="ml-2 text-left text-gray-600 mb-4">{{ $data[0]['description'] }}</p>

        <h3 class="font-semibold text-lg text-center">Fasilitas</h3>
        <ul class="flex flex-wrap justify-center space-x-2">
            <!-- Example facility -->
            <li class="bg-blue-100 text-blue-700 px-2 py-1 rounded">Facility</li>
        </ul>
    </div>
</div>

<!-- Reviews Section -->
<div class="w-11/12 mx-auto mt-10">
    <h3 class="font-semibold text-lg text-center">Reviews</h3>
    <div class="space-y-4">
        @foreach ($data as $item)
            <div class="border p-4 flex rounded-md shadow-sm">
                <p class="font-bold">{{ $item['review'] }}</p>
                <span>
                    <div class="flex">
                        @for ($i = 1; $i <= $item['star']; $i++)
                            <x-star />
                        @endfor
                    </div>
                    {{-- <span class="text-gray-500">{{ $item['user_id'] }}</span> --}}
                </span>
            </div>
        @endforeach
    </div>
</div>
