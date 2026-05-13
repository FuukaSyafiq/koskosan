<x-header :user="$user" />

<style>
    .hero-gradient {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    }
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
    .text-gradient {
        background: linear-gradient(90deg, #84cc16, #22c55e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<div class="min-h-screen flex flex-col pt-12 space-y-12">
    {{-- Hero Section --}}
    <section class="hero-gradient relative overflow-hidden px-4 lg:px-6 py-24 lg:py-48">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-lime-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-green-500/20 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold text-white mb-6">
                    Welcome to <span class="text-gradient">{{config('app.name')}}</span>
                </h1>
                <p class="text-xl sm:text-2xl text-gray-300 mb-10 max-w-2xl mx-auto">
                    Temukan kos idaman Anda dengan mudah. Fasilitas lengkap, lokasi strategis, dan harga terjangkau.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/roomlist" class="px-8 py-4 bg-lime-500 hover:bg-lime-600 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-lime-500/30">
                        Lihat Kamar
                    </a>
                    <a href="/denah" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-full transition-all duration-300 border border-white/30">
                        Lihat Denah
                    </a>
                </div>
            </div>
        </div>
        
        {{-- Wave divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#EEEEEE"/>
            </svg>
        </div>
    </section>

        <!-- Bu Sri Branding Section -->
        <section class="py-20 bg-lime-50">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-8">
                <div class="md:w-1/2">
                    <img src="/assets/ibu-sri.png" alt="Bu Sri" class="w-full rounded-lg shadow-lg object-cover">
                </div>
                <div class="md:w-1/2">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Bu Sri – Pemilik Kos Premium</h2>
                    <p class="text-gray-600 mb-4">Dengan pengalaman lebih dari 10 tahun mengelola kos, Bu Sri memastikan setiap kamar nyaman, bersih, dan terjangkau. Lokasi strategis, fasilitas lengkap, serta pelayanan ramah menjadikan kami pilihan utama bagi para mahasiswa dan pekerja muda.</p>
                    <p class="text-gray-600">Visi kami: Menjadi tempat tinggal yang tidak hanya memberi tempat, tetapi juga rasa aman dan komunitas yang hangat.</p>
                </div>
            </div>
        </section>


    {{-- Featured Rooms Section --}}
    <section class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Kamar Pilihan</h2>
                <p class="text-gray-600 text-lg">Pilih kamar sesuai kebutuhan Anda</p>
            </div>

            @if($rooms && count($rooms) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($rooms->take(6) as $room)
                @php
                    $imageUrl = $room->image ? \Illuminate\Support\Facades\Storage::disk('s3')->url($room->image) : asset('images/no-image.png');
                @endphp
                <a href="/tiperoom/{{ $room->id }}" class="card-hover bg-white rounded-2xl overflow-hidden shadow-lg group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ $imageUrl }}" alt="{{ $room->tipe }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold">{{ $room->tipe }}</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-gray-500 text-sm">{{ $room->ukuran }}</span>
                            <div class="flex items-center text-yellow-500">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-lime-600">Rp {{ number_format($room->price, 0, ',', '.') }}</span>
                            <span class="text-sm text-gray-500">/bulan</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="/roomlist" class="inline-flex items-center text-lime-600 hover:text-lime-700 font-semibold">
                    Lihat Semua Kamar
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada kamar tersedia</p>
            </div>
            @endif
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8">
                    <div class="w-16 h-16 bg-lime-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Lokasi Strategis</h3>
                    <p class="text-gray-600">Dekat dengan kampus dan tempat umum</p>
                </div>
                <div class="text-center p-8">
                    <div class="w-16 h-16 bg-lime-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Aman & Nyaman</h3>
                    <p class="text-gray-600">Keamanan 24 jam dan fasilitas lengkap</p>
                </div>
                <div class="text-center p-8">
                    <div class="w-16 h-16 bg-lime-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Harga Terjangkau</h3>
                    <p class="text-gray-600">Kualitas terbaik dengan harga bersahabat</p>
                </div>
            </div>
        </div>
    </section>

    <x-footer />
</div>