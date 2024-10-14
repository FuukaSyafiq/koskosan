    <script src="https://aframe.io/releases/1.6.0/aframe.min.js"></script>

    <style>
        a-scene {
            width: 50%;
            /* Mengatur lebar */
            height: 50%;
            /* Mengatur tinggi */
        }

        .backBtnInVr {
            position: absolute;
            /* Membuat tombol posisinya absolut */
            top: 10px;
            /* Atur jarak dari atas */
            left: 10px;
            /* Atur jarak dari kiri */
            z-index: 1001;
            /* Pastikan tombol berada di atas scene */
            background-color: green;
            /* Warna latar belakang tombol */
            color: white;
            /* Warna teks tombol */
            border: none;
            /* Hapus border */
            padding: 10px 20px;
            /* Tambah padding untuk ukuran tombol */
            border-radius: 5px;
            /* Tambah radius untuk sudut tombol */
            cursor: pointer;
            text-decoration: none;
            /* Mengubah kursor saat hover */
        }

        .btnDetailRoom {
            position: absolute;
            /* Membuat tombol posisinya absolut */
            top: 10px;
            text-decoration: none;
            /* Atur jarak dari atas */
            left: 90px;
            /* Atur jarak dari kiri */
            z-index: 1001;
            /* Pastikan tombol berada di atas scene */
            background-color: green;
            /* Warna latar belakang tombol */
            color: white;
            /* Warna teks tombol */
            border: none;
            /* Hapus border */
            padding: 10px 20px;
            /* Tambah padding untuk ukuran tombol */
            border-radius: 5px;
            /* Tambah radius untuk sudut tombol */
            cursor: pointer;
            /* Mengubah kursor saat hover */
        }
    </style>
    @if (isset($vr))
        <a-scene>
            <!-- Gambar panorama 360 derajat -->

            <a-sky src="{{ $vr->path }}" rotation="0 180 0"></a-sky>
            <a href="/denah" class="backBtnInVr">Back</a>
            <a href="/room/{{ $vr->id }}" class="btnDetailRoom">Detail Room </a>
        </a-scene>
    @else
        <x-header />
        <div class="flex justify-center h-screen items-center flex-col">
            <a href="/denah" class="bg-green-500 p-3 px-5 rounded text-white font-bold">Back</a>

            <h1 class="font-bold text-2xl">Foto ini tidak ada vr</h1>
        </div>
    @endif
