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

<?php
    use App\Models\RentedRoom;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Storage;

    $user = auth()->check();

    if ($user) {
        $rentedRoom = RentedRoom::where('room_id', $tipeRoom[0]['id'])
            ->where('user_id', auth()->user()->id)
            ->first();
    }
    // Convert to S3 URL
    $imageUrl = Storage::disk('s3')->url($tipeRoom[0]['image']);
?>

<?php if(count($tipeRoom) > 0): ?>

    <div class="w-full m-5">
        <a href="/roomlist" class="font-bold text-blue-600 hover:underline">
            &larr; Back</a>
    </div>
    
    <div class="flex justify-center my-10 mx-5">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl"> <!-- Increased max-w to 4xl -->
            <div class="flex flex-col md:flex-row space-y-8 md:space-y-0 md:space-x-8">
                <div class="w-full md:w-1/2 lg:w-1/3">
                    <!-- Main Image Container -->
                    <?php if(isset($tipeRoom[0]['image'])): ?>
                        <div class="rounded-md overflow-hidden">
                            <img src="<?php echo e($imageUrl); ?>" class="object-cover w-full h-80" alt="Room Image" />
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Room Details -->
                <div class="flex flex-col justify-center w-full md:w-1/2 lg:w-2/3 space-y-4">
                    <h1 class="font-bold text-3xl"><?php echo e($tipeRoom[0]['tipe']); ?></h1>
                    <h2 class="font-bold text-2xl text-green-600">
                        Rp. <?php echo e(number_format($tipeRoom[0]['price'], 0, ',', '.')); ?>/Bulan
                    </h2>

                    <hr class="w-48 h-1 border-0 bg-gray-600 rounded" />

                    <div class="max-w-sm p-4">
                        <p class="mt-3 text-lg text-gray-700">Ukuran</p>
                        <p class="ml-2 text-left text-gray-600 mb-4"><?php echo e($tipeRoom[0]['ukuran']); ?></p>
                    </div>

                    <div class="max-w-sm p-4">
                        <h3 class="font-semibold text-lg">Fasilitas</h3>
                        <p class="ml-2 text-left text-gray-600 mb-4"><?php echo e($tipeRoom[0]['facility']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <h1 class="font-bold text-3xl text-center flex w-full h-screen justify-center items-center">
        Tipe Room tidak ditemukan
    </h1>
<?php endif; ?>
<?php /**PATH /home/syafiq/codingan/ayongekost/resources/views/room/tipe-room-details.blade.php ENDPATH**/ ?>