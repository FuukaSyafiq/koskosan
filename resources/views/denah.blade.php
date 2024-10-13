@php
    use App\Models\Image;
    use App\Models\Tiperoom;
    use App\Models\Room;

    $rooms = Room::getAllRoomInDenah();
    // $rooms = collect($rooms)->slice(0, 3);
    // print_r(json_encode($rooms));
@endphp

<x-header />

<div class="flex justify-between items-center flex-col w-full pt-10 my-20">
    <h1 class="font-bold text-3xl">Ini Denah Ruang KOS</h1>

    <div class="grid grid-cols-6 gap-2 my-20" id="denah">
        <!-- First row: 6 rooms -->
        @if (isset($rooms))
            @if (isset($rooms[0]))
                <div class="w-20 h-20 border border-black flex justify-center items-center room font-bold"
                    style="background-image: url('{{ $rooms[0]['path'] }}'); background-size: cover; background-position: center;"
                    onclick="showModalBox({{ $rooms[0]['id'] }})">
                    {{ $rooms[0]['name'] }}
                </div>
            @endif

            @if (isset($rooms[1]))
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room"
                    style="background-image: url('{{ $rooms[1]['path'] }}'); background-size: cover; background-position: center;"
                    onclick="showModalBox('{{ $rooms[1]['id'] }}')">
                    <span class="font-bold">{{ $rooms[1]['name'] }}</span>
                </div>
            @endif

            @if (isset($rooms[2]))
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room"
                    style="background-image: url('{{ $rooms[2]['path'] }}'); background-size: cover; background-position: center;"
                    onclick="showModalBox('{{ $rooms[2]['id'] }}')">
                    <span class="font-bold">{{ $rooms[2]['name'] }}</span>
                </div>
            @endif

            @if (isset($rooms[3]))
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room"
                    style="background-image: url('{{ $rooms[3]['path'] }}'); background-size: cover; background-position: center;"
                    onclick="showModalBox('{{ $rooms[3]['id'] }}')">
                    <span class="font-bold">{{ $rooms[3]['name'] }}</span>
                </div>
            @endif

            @if (isset($rooms[4]))
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room"
                    style="background-image: url('{{ $rooms[4]['path'] }}'); background-size: cover; background-position: center;"
                    onclick="showModalBox('{{ $rooms[4]['id'] }}')">
                    <span class="font-bold">{{ $rooms[4]['name'] }}</span>
                </div>
            @endif

            @if (isset($rooms[5]))
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room"
                    style="background-image: url('{{ $rooms[5]['path'] }}'); background-size: cover; background-position: center;"
                    onclick="showModalBox('{{ $rooms[5]['id'] }}')">
                    <span class="font-bold">{{ $rooms[5]['name'] }}</span>
                </div>
            @endif

            @if (isset($rooms[6]))
                <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room col-start-1 col-end-2"
                    style="background-image: url('{{ $rooms[6]['path'] }}'); background-size: cover; background-position: center;"
                    onclick="showModalBox('{{ $rooms[6]['id'] }}')">
                    <span class="font-bold">{{ $rooms[6]['name'] }}</span>
                </div>
            @endif

            <div
                class="w-full h-full bg-green-500 border border-black room col-start-2 col-end-6 row-span-2 flex items-center justify-center">
                Field
            </div>

            @if (isset($rooms[7]))
                <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room col-start-6 col-end-7"
                    style="background-image: url('{{ $rooms[7]['path'] }}'); background-size: cover; background-position: center;"
                    onclick="showModalBox('{{ $rooms[7]['id'] }}')">
                    <span class="font-bold">{{ $rooms[7]['name'] }}</span>
                </div>
            @endif

            <!-- Third row: room in the first column, room in the sixth column -->
            @if (isset($rooms[8]))
                <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room col-start-1 col-end-2"
                    style="background-image: url('{{ $rooms[8]['path'] }}'); background-size: cover; background-position: center;"
                    onclick="showModalBox('{{ $rooms[8]['id'] }}')">
                    <span class="font-bold">{{ $rooms[8]['name'] }}</span>
                </div>
            @endif

       
            @if (isset($rooms[9]))
                <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room col-start-6 col-end-7"
                    style="background-image:
                    url('{{ $rooms[8]['path'] }}'); background-size: cover; background-position: center;"
                    onclick="showModalBox('{{ $rooms[8]['id'] }}')">
                    <span class="font-bold">{{ $rooms[8]['name'] }}</span>
                </div>
            @endif

            <div class="w-full h-12 bg-blue-500 border border-black col-span-6 room flex items-center justify-center">
                Parking Lot
            </div>
        @endif
    </div>

    <div class="w-full fixed h-screen z-10 flex justify-center items-center hidden modalBox" id="modalBox">

    </div>
</div>

<script>
    const modal = document.getElementById("modalBox");

    window.document.body.onclick = (e) => {
        if (
            !e.target.classList.contains("modalBox") &&
            !e.target.classList.contains("room")
        ) {
            console.log("wkwk")
            modal.classList.add('hidden')
        }
    };

    function showModalBox(id) {
        modal.classList.remove('hidden');
        modal.innerHTML = `
 <div class="bg-white shadow-lg flex justify-center items-center w-40 h-40 modalBox rounded-lg">
 ${id}
        </div>
        `
    }
</script>
<x-footer />
