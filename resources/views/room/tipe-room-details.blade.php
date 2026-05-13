<x-header />

@php
    use App\Models\RentedRoom;
    use Illuminate\Support\Facades\Storage;

    $user = auth()->check();
    if ($user) {
        $rentedRoom = RentedRoom::where('room_id', $tipeRoom[0]['id'] ?? null)
            ->where('user_id', auth()->user()->id)
            ->first();
    }
    $imageUrl = isset($tipeRoom[0]['image']) ? Storage::disk('s3')->url($tipeRoom[0]['image']) : asset('images/no-image.png');
@endphp

<div class="min-h-screen bg-gray-50">
    {{-- Back Button --}}
    <div class="max-w-7xl mx-auto px-6 py-6">
        <a href="/roomlist" class="inline-flex items-center text-gray-600 hover:text-lime-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke List Kamar
        </a>
    </div>

    @if(count($tipeRoom) > 0)
    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-6 pb-16">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                {{-- Image Section --}}
                <div class="relative h-96 lg:h-auto">
                    <img src="{{ $imageUrl }}" alt="{{ $tipeRoom[0]['tipe'] }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <span class="bg-lime-500 text-white text-sm font-medium px-4 py-1 rounded-full">
                            {{ $tipeRoom[0]['tipe'] }}
                        </span>
                    </div>
                </div>

                {{-- Info Section --}}
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">{{ $tipeRoom[0]['tipe'] }}</h1>
                    
                    <div class="flex items-baseline mb-6">
                        <span class="text-4xl font-bold text-lime-600">Rp {{ number_format($tipeRoom[0]['price'], 0, ',', '.') }}</span>
                        <span class="text-gray-500 ml-2">/bulan</span>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-lime-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Ukuran Kamar</h4>
                                <p class="text-gray-600">{{ $tipeRoom[0]['ukuran'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-lime-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Fasilitas</h4>
                                <p class="text-gray-600">{{ $tipeRoom[0]['facility'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <a href="/denah" class="block w-full text-center bg-lime-500 hover:bg-lime-600 text-white font-semibold py-4 rounded-xl transition-all duration-300">
                            Lihat Denah Kamar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Room List in This Type --}}
        @if(isset($tipeRoom[1]))
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Kamar Available</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @for($i = 1; $i <= 4; $i++)
                    @if(isset($tipeRoom[$i]))
                    @php
                        $roomImageUrl = isset($tipeRoom[$i]['image']) ? Storage::disk('s3')->url($tipeRoom[$i]['image']) : asset('images/no-image.png');
                    @endphp
                    <a href="/room/{{ $tipeRoom[$i]['id'] }}" class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group">
                        <div class="relative h-40">
                            <img src="{{ $roomImageUrl }}" alt="{{ $tipeRoom[$i]['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-medium px-2 py-1 rounded">
                                Available
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800">{{ $tipeRoom[$i]['name'] }}</h3>
                            <p class="text-sm text-gray-500 mt-1">No. {{ $tipeRoom[$i]['name'] }}</p>
                        </div>
                    </a>
                    @endif
                @endfor
            </div>
        </div>
        @endif
    </div>
    @else
    <div class="flex items-center justify-center min-h-[60vh]">
        <div class="text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-700 mb-2">Kamar Tidak Ditemukan</h2>
            <p class="text-gray-500 mb-6">Maaf, tipe kamar yang Anda cari tidak tersedia</p>
            <a href="/roomlist" class="inline-flex items-center text-lime-600 hover:text-lime-700 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke List Kamar
            </a>
        </div>
    </div>
    @endif

    <x-footer />
</div>