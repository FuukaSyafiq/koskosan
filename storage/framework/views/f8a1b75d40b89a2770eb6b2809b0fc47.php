    <script src="https://aframe.io/releases/1.6.0/aframe.min.js"></script>

    <?php
        use Illuminate\Support\Facades\Storage;
        $vrUrl = isset($vr) && $vr->path ? Storage::disk('s3')->url($vr->path) : null;
    ?>

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
    <?php if(isset($vr)): ?>
        <a-scene>
            <!-- Gambar panorama 360 derajat -->

            <a-sky src="<?php echo e($vrUrl); ?>" rotation="0 180 0"></a-sky>
            <a href="/denah" class="backBtnInVr">Back</a>
            <a href="/room/<?php echo e($vr->id); ?>" class="btnDetailRoom">Detail Room </a>
        </a-scene>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginal2a2e454b2e62574a80c8110e5f128b60 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60 = $attributes; } ?>
<?php $component = App\View\Components\Header::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Header::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $attributes = $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $component = $__componentOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>
        <div class="mt-4 flex w-full">
            <a href="/denah" class="p-3 px-5 rounded text-blue-500 font-bold">
                < Back</a>
        </div>
        <div class="flex justify-center h-screen items-center flex-col">
            <h1 class="font-bold text-2xl">Foto ini tidak ada vr</h1>
        </div>
    <?php endif; ?>
<?php /**PATH /home/syafiq/codingan/ayongekost/resources/views/vr.blade.php ENDPATH**/ ?>