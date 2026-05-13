@php
    use App\Models\Room;
    use Illuminate\Support\Facades\Storage;

    $roomsAyoNgekostIbuSri = Room::getAllRoomInAddress('AyoNgekost Ibu Sri');
    $roomsTesting = Room::getAllRoomInAddress('tes');

    $roomsAyoNgekostIbuSri = $roomsAyoNgekostIbuSri->map(function ($room) {
        $room['image'] = $room->image ? Storage::disk('s3')->url($room->image) : asset('images/no-image.png');
        return $room;
    });
    
    $roomsTesting = $roomsTesting->map(function ($room) {
        $room['image'] = $room->image ? Storage::disk('s3')->url($room->image) : asset('images/no-image.png');
        return $room;
    });
@endphp

<style>
    .room-card {
        transition: all 0.3s ease;
    }
    .room-card:hover {
        transform: scale(1.05);
        z-index: 10;
    }
    .room-card:hover .room-overlay {
        opacity: 1;
    }
</style>

<x-header />

<div class="min-h-screen bg-gray-50">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-lime-600 to-green-600 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-3">Denah Kamar Kos</h1>
            <p class="text-xl text-white/80">Peta lokasi kamar kos kami</p>
        </div>
    </div>

    {{-- Floor Plan Section --}}
    <main class="max-w-7xl mx-auto px-6 py-12">
        @if(isset($roomsAyoNgekostIbuSri[0]['address']))
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">{{ $roomsAyoNgekostIbuSri[0]['address'] }}</h2>
                <div class="flex gap-4 text-sm">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-lime-500 rounded mr-2"></div>
                        <span>Tersedia</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-red-500 rounded mr-2"></div>
                        <span>Terisi</span>
                    </div>
                </div>
            </div>

            {{-- Map Grid --}}
            <div class="bg-white rounded-3xl shadow-lg p-8">
                <div class="grid grid-cols-6 gap-4">
                    {{-- Row 1: 6 rooms --}}
                    @for($i = 0; $i < 6; $i++)
                        @if(isset($roomsAyoNgekostIbuSri[$i]))
                        <div class="room-card relative aspect-square rounded-xl overflow-hidden cursor-pointer group"
                             style="background-image: url('{{ $roomsAyoNgekostIbuSri[$i]['image'] }}'); background-size: cover; background-position: center;"
                             data-id="{{ $roomsAyoNgekostIbuSri[$i]['id'] }}"
                             data-name="{{ $roomsAyoNgekostIbuSri[$i]['name'] }}">
                            <div class="room-overlay absolute inset-0 bg-black/60 opacity-0 transition-opacity duration-300 flex items-center justify-center">
                                <span class="text-white font-bold text-center">{{ $roomsAyoNgekostIbuSri[$i]['name'] }}</span>
                            </div>
                            <div class="absolute bottom-2 left-2 right-2">
                                <span class="bg-black/70 text-white text-xs px-2 py-1 rounded block text-center">
                                    {{ $roomsAyoNgekostIbuSri[$i]['name'] }}
                                </span>
                            </div>
                        </div>
                        @else
                        <div class="aspect-square rounded-xl bg-gray-100"></div>
                        @endif
                    @endfor

                    {{-- Row 2: Room + Field + Room --}}
                    @if(isset($roomsAyoNgekostIbuSri[6]))
                    <div class="room-card relative aspect-square rounded-xl overflow-hidden cursor-pointer"
                         style="background-image: url('{{ $roomsAyoNgekostIbuSri[6]['image'] }}'); background-size: cover; background-position: center;"
                         data-id="{{ $roomsAyoNgekostIbuSri[6]['id'] }}"
                         data-name="{{ $roomsAyoNgekostIbuSri[6]['name'] }}">
                        <div class="room-overlay absolute inset-0 bg-black/60 opacity-0 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-bold">{{ $roomsAyoNgekostIbuSri[6]['name'] }}</span>
                        </div>
                        <div class="absolute bottom-2 left-2 right-2">
                            <span class="bg-black/70 text-white text-xs px-2 py-1 rounded block text-center">
                                {{ $roomsAyoNgekostIbuSri[6]['name'] }}
                            </span>
                        </div>
                    </div>
                    @else
                    <div class="aspect-square rounded-xl bg-gray-100"></div>
                    @endif

                    <div class="col-span-4 aspect-square rounded-xl bg-green-100 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-8 h-8 text-green-500 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            <span class="text-green-600 font-medium">Taman</span>
                        </div>
                    </div>

                    @if(isset($roomsAyoNgekostIbuSri[7]))
                    <div class="room-card relative aspect-square rounded-xl overflow-hidden cursor-pointer"
                         style="background-image: url('{{ $roomsAyoNgekostIbuSri[7]['image'] }}'); background-size: cover; background-position: center;"
                         data-id="{{ $roomsAyoNgekostIbuSri[7]['id'] }}"
                         data-name="{{ $roomsAyoNgekostIbuSri[7]['name'] }}">
                        <div class="room-overlay absolute inset-0 bg-black/60 opacity-0 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-bold">{{ $roomsAyoNgekostIbuSri[7]['name'] }}</span>
                        </div>
                        <div class="absolute bottom-2 left-2 right-2">
                            <span class="bg-black/70 text-white text-xs px-2 py-1 rounded block text-center">
                                {{ $roomsAyoNgekostIbuSri[7]['name'] }}
                            </span>
                        </div>
                    </div>
                    @else
                    <div class="aspect-square rounded-xl bg-gray-100"></div>
                    @endif

                    {{-- Row 3: Room + Room --}}
                    @if(isset($roomsAyoNgekostIbuSri[8]))
                    <div class="room-card relative aspect-square rounded-xl overflow-hidden cursor-pointer"
                         style="background-image: url('{{ $roomsAyoNgekostIbuSri[8]['image'] }}'); background-size: cover; background-position: center;"
                         data-id="{{ $roomsAyoNgekostIbuSri[8]['id'] }}"
                         data-name="{{ $roomsAyoNgekostIbuSri[8]['name'] }}">
                        <div class="room-overlay absolute inset-0 bg-black/60 opacity-0 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-bold">{{ $roomsAyoNgekostIbuSri[8]['name'] }}</span>
                        </div>
                        <div class="absolute bottom-2 left-2 right-2">
                            <span class="bg-black/70 text-white text-xs px-2 py-1 rounded block text-center">
                                {{ $roomsAyoNgekostIbuSri[8]['name'] }}
                            </span>
                        </div>
                    </div>
                    @else
                    <div class="aspect-square rounded-xl bg-gray-100"></div>
                    @endif


                    @if(isset($roomsAyoNgekostIbuSri[9]))
                    <div class="room-card relative aspect-square rounded-xl overflow-hidden cursor-pointer"
                         style="background-image: url('{{ $roomsAyoNgekostIbuSri[9]['image'] }}'); background-size: cover; background-position: center;"
                         data-id="{{ $roomsAyoNgekostIbuSri[9]['id'] }}"
                         data-name="{{ $roomsAyoNgekostIbuSri[9]['name'] }}">
                        <div class="room-overlay absolute inset-0 bg-black/60 opacity-0 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-bold">{{ $roomsAyoNgekostIbuSri[9]['name'] }}</span>
                        </div>
                        <div class="absolute bottom-2 left-2 right-2">
                            <span class="bg-black/70 text-white text-xs px-2 py-1 rounded block text-center">
                                {{ $roomsAyoNgekostIbuSri[9]['name'] }}
                            </span>
                        </div>
                    </div>
                    @else
                    <div class="aspect-square rounded-xl bg-gray-100"></div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if(isset($roomsTesting[0]['address']))
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ $roomsTesting[0]['address'] }}</h2>
            <div class="bg-white rounded-3xl shadow-lg p-8">
                <div class="grid grid-cols-6 gap-4">
                    @if(isset($roomsTesting[0]))
                    <div class="room-card relative aspect-square rounded-xl overflow-hidden cursor-pointer"
                         style="background-image: url('{{ $roomsTesting[0]['image'] }}'); background-size: cover; background-position: center;"
                         data-id="{{ $roomsTesting[0]['id'] }}"
                         data-name="{{ $roomsTesting[0]['name'] }}">
                        <div class="room-overlay absolute inset-0 bg-black/60 opacity-0 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-bold">{{ $roomsTesting[0]['name'] }}</span>
                        </div>
                        <div class="absolute bottom-2 left-2 right-2">
                            <span class="bg-black/70 text-white text-xs px-2 py-1 rounded block text-center">
                                {{ $roomsTesting[0]['name'] }}
                            </span>
                        </div>
                    </div>
                    @endif
                    <div class="col-span-4 aspect-square rounded-xl bg-green-100 flex items-center justify-center">
                        <span class="text-green-600 font-medium">Taman</span>
                    </div>
                    <div class="col-span-1"></div>
                    <div class="col-span-4 aspect-square rounded-xl bg-blue-100 flex items-center justify-center">
                        <span class="text-blue-600 font-medium">Parkiran</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </main>

    {{-- Modal --}}
    <div id="room-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="flex items-center justify-center min-h-screen p-6">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6 transform transition-all scale-100">
                <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <div class="text-center">
                    <h3 id="modal-room-name" class="text-2xl font-bold text-gray-800 mb-2">Nama Kamar</h3>
                    <p class="text-gray-500 mb-6">Pilih aksi yang ingin dilakukan</p>
                    <div class="space-y-3">
                        <a id="modal-detail-btn" href="#" class="block w-full bg-lime-500 hover:bg-lime-600 text-white font-semibold py-3 rounded-xl transition-colors">
                            Lihat Detail
                        </a>
                        <a id="modal-vr-btn" href="#" class="block w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold py-3 rounded-xl transition-colors">
                            Lihat Virtual Tour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-footer />

<script>
    const modal = document.getElementById('room-modal');
    const modalRoomName = document.getElementById('modal-room-name');
    const modalDetailBtn = document.getElementById('modal-detail-btn');
    const modalVrBtn = document.getElementById('modal-vr-btn');

    document.querySelectorAll('[data-id]').forEach(btn => {
        btn.addEventListener('click', () => {
            const roomId = btn.getAttribute('data-id');
            const roomName = btn.getAttribute('data-name') || 'Kamar ' + roomId;
            
            modalRoomName.textContent = roomName;
            modalDetailBtn.href = '/room/' + roomId;
            modalVrBtn.href = '/room/vr/' + roomId;
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });
</script>