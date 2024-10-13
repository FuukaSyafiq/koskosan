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
                    data-id="{{ $rooms[0]['id'] }}" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    {{ $rooms[0]['name'] }}
                </div>
            @endif

            @if (isset($rooms[1]))
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room"
                    style="background-image: url('{{ $rooms[1]['path'] }}'); background-size: cover; background-position: center;"
                    data-modal-target="default-modal" data-modal-toggle="default-modal"data-id="{{ $rooms[1]['id'] }}">
                    <span class="font-bold">{{ $rooms[1]['name'] }}</span>
                </div>
            @endif

            @if (isset($rooms[2]))
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room"
                    style="background-image: url('{{ $rooms[2]['path'] }}'); background-size: cover; background-position: center;"
                    data-modal-target="default-modal" data-modal-toggle="default-modal"data-id="{{ $rooms[2]['id'] }}">
                    <span class="font-bold">{{ $rooms[2]['name'] }}</span>
                </div>
            @endif

            @if (isset($rooms[3]))
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room"
                    style="background-image: url('{{ $rooms[3]['path'] }}'); background-size: cover; background-position: center;"
                    data-modal-target="default-modal" data-modal-toggle="default-modal"data-id="{{ $rooms[3]['id'] }}">
                    <span class="font-bold">{{ $rooms[3]['name'] }}</span>
                </div>
            @endif

            @if (isset($rooms[4]))
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room"
                    style="background-image: url('{{ $rooms[4]['path'] }}'); background-size: cover; background-position: center;"
                    data-modal-target="default-modal" data-modal-toggle="default-modal"data-id="{{ $rooms[4]['id'] }}">
                    <span class="font-bold">{{ $rooms[4]['name'] }}</span>
                </div>
            @endif

            @if (isset($rooms[5]))
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room"
                    style="background-image: url('{{ $rooms[5]['path'] }}'); background-size: cover; background-position: center;"
                    data-modal-target="default-modal" data-modal-toggle="default-modal"data-id="{{ $rooms[5]['id'] }}">
                    <span class="font-bold">{{ $rooms[5]['name'] }}</span>
                </div>
            @endif

            @if (isset($rooms[6]))
                <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room col-start-1 col-end-2"
                    style="background-image: url('{{ $rooms[6]['path'] }}'); background-size: cover; background-position: center;"
                    data-modal-target="default-modal" data-modal-toggle="default-modal"data-id="{{ $rooms[6]['id'] }}">
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
                    data-modal-target="default-modal" data-modal-toggle="default-modal"data-id="{{ $rooms[7]['id'] }}">
                    <span class="font-bold">{{ $rooms[7]['name'] }}</span>
                </div>
            @endif

            <!-- Third row: room in the first column, room in the sixth column -->
            @if (isset($rooms[8]))
                <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room col-start-1 col-end-2"
                    style="background-image: url('{{ $rooms[8]['path'] }}'); background-size: cover; background-position: center;"
                    data-modal-target="default-modal" data-modal-toggle="default-modal"data-id="{{ $rooms[8]['id'] }}">
                    <span class="font-bold">{{ $rooms[8]['name'] }}</span>
                </div>
            @endif


            @if (isset($rooms[9]))
                <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
                <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room col-start-6 col-end-7"
                    style="background-image:
                    url('{{ $rooms[9]['path'] }}'); background-size: cover; background-position: center;"
                    data-modal-target="default-modal" data-modal-toggle="default-modal"data-id="{{ $rooms[9]['id'] }}">
                    <span class="font-bold">{{ $rooms[9]['name'] }}</span>
                </div>
            @endif

            <div class="w-full h-12 bg-blue-500 border border-black col-span-6 room flex items-center justify-center">
                Parking Lot
            </div>
        @endif
    </div>

    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center" id="modalTitle">
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4" id="modalContent">
                    {{-- <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        With less than a month to go before the European Union enacts new consumer privacy laws for its
                        citizens, companies around the world are updating their terms of service agreements to comply.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25
                        and is meant to ensure a common set of data rights in the European Union. It requires
                        organizations to notify users as soon as possible of high-risk data breaches that could
                        personally affect them.
                    </p> --}}
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600"
                    id="modalButton">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function getVr(id) {
        const data = await fetch('/room/vr/' + id, {
            method: "GET",
            headers: {
                "Content-type": "application/json"
            }
        })

        return await data.json();
    }
    const modalContent = document.getElementById('modalContent')
    const modalButton = document.getElementById('modalButton')
    const modalTitle = document.getElementById('modalTitle')

    document.querySelectorAll('[data-id]').forEach(button => {
        button.addEventListener('click', async () => {
            const roomId = button.getAttribute('data-id');
            const vr = await getVr(roomId)
            modalTitle.textContent = `Tampilan VR Ruang ${roomId}`
            modalContent.innerHTML = `
                <img src="${vr.path}"/>
            `
            modalButton.innerHTML = `<a href="/room/${roomId}" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Detail room</a>
                    <button data-modal-hide="default-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
            `
        });
    });
</script>
<x-footer />
