<x-header />

@php
    use App\Models\RentedRoom;
    use Carbon\Carbon;

    $user = auth()->check();

    if ($user) {
        $rentedRoom = RentedRoom::where('room_id', $tipeRoom[0]['id'])
            ->where('user_id', auth()->user()->id)
            ->first();
    }
    $vrImage = collect($tipeRoom)->firstWhere('is_vr', true);

    // Jika tidak ada gambar VR, ambil gambar pertama sebagai fallback
    $imagePath = $vrImage ? $vrImage['path'] : $tipeRoom[0]['path'];

@endphp

@if (count($tipeRoom) > 0)
    <div class="w-full m-5">
        <a href="/" class="font-bold">Back</a>
    </div>
    <div class="flex w-11/12 mx-auto my-auto pt-7 justify-center items-center flex-col md:flex-col lg:flex-row">
        <div class="flex flex-col mt-10 w-full md:w-full lg:w-1/3 space-y-4">
            <!-- Main Image Container -->
            @if (isset($tipeRoom[0]['path']))
                <div class="w-full rounded-md overflow-hidden">
                    <img src="{{ $imagePath }}" class="object-cover w-full h-80" alt="image" />
                </div>
            @endif()
        </div>

        <!-- Room Details -->
        <div class="flex flex-col justify-center w-full md:w-full lg:w-1/3 mt-5 space-y-4">
            <h1 class="font-bold text-3xl text-center">{{ $tipeRoom[0]['tipe'] }}</h1>
            <div class="flex justify-center items-center">
            </div>
            <h2 class="font-bold text-2xl text-center">
                Rp. {{ number_format($tipeRoom[0]['price'], 0, ',', '.') }}/Bulan

            </h2>

            <hr class="w-48 h-1 mx-auto border-0 bg-gray-600 rounded" />

            <div class="block max-w-sm p-6 mx-auto">
                <p class="mt-3 text-lg text-center text-gray-700">Ukuran</p>
                <p class="ml-2 text-left text-gray-600 mb-4">{{ $tipeRoom[0]['ukuran'] }}</p>
            </div>

            <div class="block max-w-sm p-6 mx-auto">
                <h3 class="font-semibold text-lg text-center">Fasilitas</h3>

                <p class="ml-2 text-left text-gray-600 mb-4">{{ $tipeRoom[0]['facility'] }}</p>

            </div>
        </div>
    </div>
@else
    <h1 class="font-bold text-3xl text-center flex w-full h-screen justify-center items-center">Tipe Room tidak ditemukan
    </h1>
@endif
