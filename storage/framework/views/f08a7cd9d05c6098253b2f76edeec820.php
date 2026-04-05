<?php
    use App\Models\Image;
    use App\Models\Tiperoom;
    use App\Models\Room;
    use Illuminate\Support\Facades\Storage;

    $roomsAyoNgekostIbuSri = Room::getAllRoomInAddress('AyoNgekost Ibu Sri');
    $roomsTesting = Room::getAllRoomInAddress('tes');

    // Convert all room images to S3 URLs
    $roomsAyoNgekostIbuSri = $roomsAyoNgekostIbuSri->map(function ($room) {
        $room['image'] = $room->image ? Storage::disk('s3')->url($room->image) : asset('images/no-image.png');
        return $room;
    });
    
    $roomsTesting = $roomsTesting->map(function ($room) {
        $room['image'] = $room->image ? Storage::disk('s3')->url($room->image) : asset('images/no-image.png');
        return $room;
    });
?>
<style>

</style>

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

<?php if(isset($roomsAyoNgekostIbuSri[0]['address'])): ?>
    <div class="flex justify-between items-center flex-col w-full pt-10 my-20">
        <h1 class="font-bold text-3xl">Ini Denah Ruang <?php echo e($roomsAyoNgekostIbuSri[0]['address']); ?></h1>

        <div class="grid grid-cols-6 gap-2 my-20" id="denah">
            <!-- First row: 6 roomsAyoNgekostIbuSri -->
            <?php if(isset($roomsAyoNgekostIbuSri)): ?>
                <?php if(isset($roomsAyoNgekostIbuSri[0])): ?>
                    <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center text-white"
                        style="background-image: url('<?php echo e($roomsAyoNgekostIbuSri[0]['image']); ?>'); background-size: cover; background-position: center;"
                        data-id="<?php echo e($roomsAyoNgekostIbuSri[0]['id']); ?>" data-modal-target="default-modal"
                        data-modal-toggle="default-modal">
                        <?php echo e($roomsAyoNgekostIbuSri[0]['name']); ?>

                    </div>
                <?php endif; ?>

                <?php if(isset($roomsAyoNgekostIbuSri[1])): ?>
                    <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center text-white"
                        style="background-image: url('<?php echo e($roomsAyoNgekostIbuSri[1]['image']); ?>'); background-size: cover; background-position: center;"
                        data-modal-target="default-modal"
                        data-modal-toggle="default-modal"data-id="<?php echo e($roomsAyoNgekostIbuSri[1]['id']); ?>">
                        <span class="font-bold"><?php echo e($roomsAyoNgekostIbuSri[1]['name']); ?></span>
                    </div>
                <?php endif; ?>

                <?php if(isset($roomsAyoNgekostIbuSri[2])): ?>
                    <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center text-white"
                        style="background-image: url('<?php echo e($roomsAyoNgekostIbuSri[2]['image']); ?>'); background-size: cover; background-position: center;"
                        data-modal-target="default-modal"
                        data-modal-toggle="default-modal"data-id="<?php echo e($roomsAyoNgekostIbuSri[2]['id']); ?>">
                        <span class="font-bold"><?php echo e($roomsAyoNgekostIbuSri[2]['name']); ?></span>
                    </div>
                <?php endif; ?>

                <?php if(isset($roomsAyoNgekostIbuSri[3])): ?>
                    <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center text-white"
                        style="background-image: url('<?php echo e($roomsAyoNgekostIbuSri[3]['image']); ?>'); background-size: cover; background-position: center;"
                        data-modal-target="default-modal"
                        data-modal-toggle="default-modal"data-id="<?php echo e($roomsAyoNgekostIbuSri[3]['id']); ?>">
                        <span class="font-bold"><?php echo e($roomsAyoNgekostIbuSri[3]['name']); ?></span>
                    </div>
                <?php endif; ?>

                <?php if(isset($roomsAyoNgekostIbuSri[4])): ?>
                    <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center text-white"
                        style="background-image: url('<?php echo e($roomsAyoNgekostIbuSri[4]['image']); ?>'); background-size: cover; background-position: center;"
                        data-modal-target="default-modal"
                        data-modal-toggle="default-modal"data-id="<?php echo e($roomsAyoNgekostIbuSri[4]['id']); ?>">
                        <span class="font-bold"><?php echo e($roomsAyoNgekostIbuSri[4]['name']); ?></span>
                    </div>
                <?php endif; ?>

                <?php if(isset($roomsAyoNgekostIbuSri[5])): ?>
                    <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center text-white"
                        style="background-image: url('<?php echo e($roomsAyoNgekostIbuSri[5]['image']); ?>'); background-size: cover; background-position: center;"
                        data-modal-target="default-modal"
                        data-modal-toggle="default-modal"data-id="<?php echo e($roomsAyoNgekostIbuSri[5]['id']); ?>">
                        <span class="font-bold"><?php echo e($roomsAyoNgekostIbuSri[5]['name']); ?></span>
                    </div>
                <?php endif; ?>

                <?php if(isset($roomsAyoNgekostIbuSri[6])): ?>
                    <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
                    <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center text-white col-start-1 col-end-2"
                        style="background-image: url('<?php echo e($roomsAyoNgekostIbuSri[6]['image']); ?>'); background-size: cover; background-position: center;"
                        data-modal-target="default-modal"
                        data-modal-toggle="default-modal"data-id="<?php echo e($roomsAyoNgekostIbuSri[6]['id']); ?>">
                        <span class="font-bold"><?php echo e($roomsAyoNgekostIbuSri[6]['name']); ?></span>
                    </div>
                <?php endif; ?>

                <div
                    class="w-full h-full bg-green-500 border border-black room col-start-2 col-end-6 row-span-2 flex items-center justify-center">
                    Field
                </div>

                <?php if(isset($roomsAyoNgekostIbuSri[7])): ?>
                    <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
                    <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center text-white col-start-6 col-end-7"
                        style="background-image: url('<?php echo e($roomsAyoNgekostIbuSri[7]['image']); ?>'); background-size: cover; background-position: center;"
                        data-modal-target="default-modal"
                        data-modal-toggle="default-modal"data-id="<?php echo e($roomsAyoNgekostIbuSri[7]['id']); ?>">
                        <span class="font-bold"><?php echo e($roomsAyoNgekostIbuSri[7]['name']); ?></span>
                    </div>
                <?php endif; ?>

                <!-- Third row: room in the first column, room in the sixth column -->
                <?php if(isset($roomsAyoNgekostIbuSri[8])): ?>
                    <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
                    <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center text-white col-start-1 col-end-2"
                        style="background-image: url('<?php echo e($roomsAyoNgekostIbuSri[8]['image']); ?>'); background-size: cover; background-position: center;"
                        data-modal-target="default-modal"
                        data-modal-toggle="default-modal"data-id="<?php echo e($roomsAyoNgekostIbuSri[8]['id']); ?>">
                        <span class="font-bold"><?php echo e($roomsAyoNgekostIbuSri[8]['name']); ?></span>
                    </div>
                <?php endif; ?>


                <?php if(isset($roomsAyoNgekostIbuSri[9])): ?>
                    <!-- Second row: room in the first column, 'Field' spanning 4 columns, room in the sixth column -->
                    <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center text-white col-start-6 col-end-7"
                        style="background-image:
                    url('<?php echo e($roomsAyoNgekostIbuSri[9]['image']); ?>'); background-size: cover; background-position: center;"
                        data-modal-target="default-modal"
                        data-modal-toggle="default-modal"data-id="<?php echo e($roomsAyoNgekostIbuSri[9]['id']); ?>">
                        <span class="font-bold"><?php echo e($roomsAyoNgekostIbuSri[9]['name']); ?></span>
                    </div>
                <?php endif; ?>

                <div
                    class="w-full h-12 bg-blue-500 border border-black col-span-6 room flex items-center justify-center">
                    Parking Lot
                </div>
            <?php endif; ?>
        </div>

        <!-- Modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-sm max-h-full">
                <!-- Adjusted modal width to max-w-sm for smaller size -->
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center" id="modalTitle">
                            Modal Title
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4" id="modalContent">
                        <p>Pilih opsi detail yang tersedia</p>
                        <div class="flex justify-center gap-4"> <!-- Flexbox to center buttons side by side -->
                            <!-- Buttons will be injected here via JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
<?php endif; ?>

<?php if(isset($roomsTesting[0]['address'])): ?>
    <div class="flex justify-between items-center flex-col w-full pt-10 my-20">
        <h1 class="font-bold text-3xl">Ini Denah Ruang
            <?php echo e($roomsTesting[0]['address'] ? $roomsTesting[0]['address'] : null); ?></h1>

        <div class="grid grid-cols-6 gap-2 my-20" id="denah">
            <!-- First row: 6 roomsAyoNgekostIbuSri -->
            <?php if(isset($roomsTesting)): ?>
                <?php if(isset($roomsTesting[0])): ?>
                    <div class="w-20 h-20 bg-red-700 border border-black flex justify-center items-center text-white"
                        style="background-image: url('<?php echo e($roomsTesting[0]['image']); ?>'); background-size: cover; background-position: center;"
                        data-id="<?php echo e($roomsTesting[0]['id']); ?>" data-modal-target="default-modal"
                        data-modal-toggle="default-modal">
                        <?php echo e($roomsTesting[0]['name']); ?>

                    </div>
                <?php endif; ?>

                <div
                    class="w-full h-full bg-green-500 border border-black room col-start-2 col-end-6 row-span-2 flex items-center justify-center">
                    Field
                </div>
                <div
                    class="w-full h-12 bg-blue-500 border border-black col-span-6 room flex items-center justify-center">
                    Parking Lot
                </div>
            <?php endif; ?>
        </div>

    </div>
<?php endif; ?>

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
            modalTitle.textContent = `Pilih aksi`;
            modalContent.innerHTML = `
            <div class="flex justify-center gap-4"> <!-- Center the buttons -->
                <a href="/room/${roomId}" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Detail Room
                </a>
                <a href="/room/vr/${roomId}" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Lihat VR
                </a>
            </div>
        `;
        });
    });
</script>
<?php if (isset($component)) { $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $attributes; } ?>
<?php $component = App\View\Components\Footer::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Footer::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $attributes = $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $component = $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>
<?php /**PATH /home/syafiq/codingan/ayongekost/resources/views/denah.blade.php ENDPATH**/ ?>