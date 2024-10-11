<x-header />

<div class="flex justify-between items-center flex-col w-full pt-10 my-20">
    <h1 class="font-bold text-3xl">Ini Denah Ruang KOS</h1>

    <div class="grid grid-cols-6 gap-2 my-20" id="denah">
        <!-- First row: 6 rooms -->
        @for ($i = 1; $i <= 6; $i++)
            <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center room"
                onclick="showModalBox('<?= $i ?>')">room
                {{ $i }}</div>
        @endfor

        <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
        <div class="w-20 h-20 bg-red-700 border border-black col-start-1 col-end-2 room" onclick="showModalBox(7)">room
            7</div>
        <div
            class="w-full h-full bg-green-500 border border-black room col-start-2 col-end-6 row-span-2 flex items-center justify-center">
            Field
        </div>
        <div class="w-20 h-20 bg-red-700 border border-black col-start-6 room col-end-7" onclick="showModalBox(8)">room
            8</div>

        <!-- Third row: room in the first column, room in the sixth column -->

        {{-- @for ($i = 1; $i <= 7; $i += 5) --}}
        <div class="w-20 h-20 bg-red-700 border border-black col-start-1 room col-end-2 flex justify-center items-center"
            onclick="showModalBox(9)">
            room 9</div>
        <div
            class="w-20 h-20 bg-red-700 border border-black col-start-6 room col-end-7 flex justify-center items-center"onclick="showModalBox(10)">
            room 10</div>
        {{-- @endfor --}}
        <div class="w-full h-12 bg-blue-500 border border-black col-span-6 room flex items-center justify-center">
            Parking Lot
        </div>

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
