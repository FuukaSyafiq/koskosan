@props([
    'data' => [
        'id' => 10,
        'room_name' => 'Kos Sragen TV dengan Kamar Mandi',
        'price' => 100000,
        'kos_name' => 'Kos Umi Qosim',
        'address' => 'BABADAN RT 02, WONOREJO, KEDAWUNG, SRAGEN',
        'star' => 5,
        'path' =>
            'https://sgp1.digitaloceanspaces.com/www.sewakost.com-66ae3a396f56c/listings/03-2022/ad76102/kost-putri-46-yogyakarta-662668431_x2.jpg',
        'file_name' => 'B5.jpg',
    ],
])


<div class="m-2 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="/room/{{ $data->id }}">
        <img class="p-4 rounded-t-lg object-cover w-52 h-52" src="{{ $data->path }}" alt="product image" />
        <div class="p-5 h-56 flex flex-col">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white flex-1">{{ $data->room_name }}</h5>
            <div class="flex items-center mt-2.5 mb-5">
                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                    @for ($i = 1; $i <= $data->star; $i++)
                        <x-star />
                    @endfor
                </div>
                <span
                    class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">
                    {{ $data->star }}.0</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900 dark:text-white price"
                    data-price="{{ $data->price }}">{{ number_format($data->price, 0, ',', '.') }}</span>
            </div>
        </div>
    </a>
</div>

