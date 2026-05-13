<x-header />

@php
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

$imageUrls = [];
if (isset($room[0]['image'])) {
    for ($i = 0; $i <= 4; $i++) {
        if (isset($room[$i]['image'])) {
            $imageUrls[$i] = Storage::disk('s3')->url($room[$i]['image']);
        }
    }
}
@endphp

<style>
    .gallery-thumb.active {
        border-color: #84cc16;
    }
</style>

<div class="min-h-screen bg-gray-50">
    {{-- Back Button --}}
    <div class="max-w-7xl mx-auto px-6 py-6">
        <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-lime-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
    </div>

    @if(count($room) > 0)
    <div class="max-w-7xl mx-auto px-6 pb-16">
        {{-- Main Image Gallery --}}
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden mb-8">
            <div class="relative h-96 lg:h-[500px]">
                <img id="mainImage" src="{{ $imageUrls[0] ?? asset('images/no-image.png') }}" class="w-full h-full object-cover" alt="{{ $room[0]['name'] }}">
                <div class="absolute top-4 right-4 bg-lime-500 text-white text-sm font-medium px-4 py-1 rounded-full">
                    {{ $room[0]['name'] }}
                </div>
            </div>
            @if(count($imageUrls) > 1)
            <div class="p-4 flex gap-3 overflow-x-auto">
                @foreach($imageUrls as $index => $url)
                <button onclick="changeImage('{{ $url }}', this)" class="gallery-thumb flex-shrink-0 w-24 h-20 rounded-lg overflow-hidden border-2 border-transparent transition-all {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ $url }}" class="w-full h-full object-cover" alt="Thumbnail {{ $index + 1 }}">
                </button>
                @endforeach
            </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Room Info --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">{{ $room[0]['name'] }}</h1>
                            <p class="text-gray-500 mt-1">Tipe: {{ $tipeRoom }}</p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <span class="text-3xl font-bold text-lime-600">Rp {{ number_format($price, 0, ',', '.') }}</span>
                            <span class="text-gray-500">/bulan</span>
                        </div>
                    </div>

                    {{-- Rating --}}
                    <div class="flex items-center mb-6 p-4 bg-gray-50 rounded-xl">
                        @if($avgRating->avg_star == 0)
                        <span class="bg-gray-200 text-gray-600 text-sm font-medium px-3 py-1 rounded-full">Belum ada review</span>
                        @else
                        <span class="bg-lime-100 text-lime-700 text-sm font-bold px-3 py-1 rounded-full mr-3">
                            {{ number_format($avgRating->avg_star, 1) }}
                        </span>
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $avgRating->avg_star ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        @endif
                    </div>

                    {{-- Description --}}
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Deskripsi</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $room[0]['description'] }}</p>
                    </div>

                    {{-- Facilities --}}
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Fasilitas</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $facility) as $fac)
                            <span class="bg-lime-100 text-lime-700 px-3 py-1 rounded-full text-sm font-medium">
                                {{ trim($fac) }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- VR Button --}}
                @if($room[0]['image_vr'])
                <div class="mt-6 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold">Virtual Tour 360°</h3>
                            <p class="text-purple-200 mt-1">Lihat ruangan secara immersif</p>
                        </div>
                        <a href="/room/vr/{{ $room[0]['id'] }}" class="bg-white text-purple-600 px-6 py-3 rounded-xl font-semibold hover:bg-purple-50 transition-colors">
                            Lihat VR
                        </a>
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Booking Kamar</h3>
                    <div class="space-y-4">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-3 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ $room[0]['address'] }}</span>
                        </div>
                    </div>
                    @auth
                    <a href="/penyewa" class="block w-full text-center bg-lime-500 hover:bg-lime-600 text-white font-semibold py-4 rounded-xl mt-6 transition-all duration-300">
                        Booking Sekarang
                    </a>
                    @else
                    <a href="/login" class="block w-full text-center bg-lime-500 hover:bg-lime-600 text-white font-semibold py-4 rounded-xl mt-6 transition-all duration-300">
                        Login untuk Booking
                    </a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- Reviews Section --}}
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Review & Rating</h2>
            @if(!isset($review[0]))
            <div class="bg-white rounded-xl shadow p-8 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <p class="text-gray-500">Belum ada review untuk kamar ini</p>
            </div>
            @else
            <div class="space-y-4">
                @foreach($review as $item)
                @if(isset($item->review))
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-lime-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-lime-600 font-bold">{{ substr($item->name ?? 'U', 0, 1) }}</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $item->name }}</h4>
                                <p class="text-sm text-gray-500">{{ Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $item->star ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-gray-600 mt-4">{{ $item->review }}</p>
                </div>
                @endif
                @endforeach
            </div>
            @endif
        </div>
    </div>
    @else
    <div class="flex items-center justify-center min-h-[60vh]">
        <div class="text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-700 mb-2">Kamar Tidak Ditemukan</h2>
            <a href="/roomlist" class="text-lime-600 hover:text-lime-700 font-medium">Kembali ke List Kamar</a>
        </div>
    </div>
    @endif

    <x-footer />
</div>

<script>
function changeImage(src, element) {
    document.getElementById('mainImage').src = src;
    document.querySelectorAll('.gallery-thumb').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
}
</script>