<x-header :user="$user" />

<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }
    .filter-btn.active {
        background-color: #84cc16;
        color: white;
    }
</style>

<div class="min-h-screen flex flex-col">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-lime-600 to-green-600 py-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">Kamar Kos</h1>
            <p class="text-xl text-white/80">Pilih kamar terbaik sesuai kebutuhan Anda</p>
        </div>
    </div>

    {{-- Room List --}}
    <main class="flex-grow py-12">
        <div class="max-w-7xl mx-auto px-6">
            @if($rooms && count($rooms) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($rooms as $room)
                @php
                    $imageUrl = $room->image ? \Illuminate\Support\Facades\Storage::disk('s3')->url($room->image) : asset('images/no-image.png');
                @endphp
                <a href="/tiperoom/{{ $room->id }}" class="card-hover bg-white rounded-2xl overflow-hidden shadow-md group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $imageUrl }}" alt="{{ $room->tipe }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <div class="absolute top-4 right-4 bg-lime-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                            Tersedia
                        </div>
                        <div class="absolute bottom-3 left-3 text-white">
                            <h3 class="text-lg font-bold">{{ $room->tipe }}</h3>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="space-y-3">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                <span class="text-sm">{{ $room->ukuran }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-sm truncate">{{ $room->facility }}</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                            <div>
                                <span class="text-2xl font-bold text-lime-600">Rp {{ number_format($room->price, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-500">/bulan</span>
                            </div>
                            <span class="text-sm text-lime-600 font-medium group-hover:underline">Lihat Detail →</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-20">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Kamar Tersedia</h3>
                <p class="text-gray-500">Silakan hubungi kami untuk informasi lebih lanjut</p>
            </div>
            @endif
        </div>
    </main>

    <x-footer />
</div>