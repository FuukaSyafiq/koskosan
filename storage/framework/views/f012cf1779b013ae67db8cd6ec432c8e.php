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

?>

<?php if(count($room) > 0): ?>
<div class="container mx-auto px-4 py-8">
    <a href="<?php echo e(url()->previous()); ?>"
        class="inline-block mb-6 font-bold text-blue-600 hover:text-blue-800 transition-colors">
        &larr; Back
    </a>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Image Container -->
        <div class="w-full lg:w-1/2">
            <?php if(isset($room[0]['image'])): ?>
            <div class="rounded-lg overflow-hidden shadow-lg">
                <img src="<?php echo e($imageUrls[0] ?? asset('images/no-image.png')); ?>" class="w-full h-auto object-cover"
                    alt="<?php echo e($room[0]['name']); ?>" />
            </div>
            <?php endif; ?>
            <?php if(isset($room[1]['image'])): ?>
            <!-- Small images beneath the main image -->
            <div class="grid grid-cols-4 gap-2 mt-4">
                <?php for($i = 1; $i <= 4; $i++): ?>
                    <?php if(isset($room[$i]['image'])): ?>
                    <div class="rounded-lg overflow-hidden shadow-lg h-32 w-32">
                    <img src="<?php echo e($imageUrls[$i] ?? asset('images/no-image.png')); ?>" class="object-cover p-auto w-full h-full"
                        alt="Image <?php echo e($i); ?>" />
            </div>
            <?php else: ?>
            <?php break; ?>
            <?php endif; ?>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Room Details -->
    <div class="w-full lg:w-1/2 space-y-6">
        <div class="text-center lg:text-left">
            <h1 class="text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">
                <?php echo e($room[0]['name']); ?>

            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Tipe: <?php echo e($tipeRoom); ?></p>
        </div>

        <div class="flex items-center justify-center lg:justify-start space-x-2">
            <?php if($avgRating->avg_star == 0): ?>
            <span
                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                Belum ada review
            </span>
            <?php else: ?>
            <span
                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                <?php echo e(number_format($avgRating->avg_star, 1)); ?>

            </span>
            <div class="flex items-center">
                <?php for($i = 1; $i <= $avgRating->avg_star; $i++): ?>
                    <?php if (isset($component)) { $__componentOriginal9b4a7831ad8686beec9bcd1313b02bc5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b4a7831ad8686beec9bcd1313b02bc5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.star','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('star'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b4a7831ad8686beec9bcd1313b02bc5)): ?>
<?php $attributes = $__attributesOriginal9b4a7831ad8686beec9bcd1313b02bc5; ?>
<?php unset($__attributesOriginal9b4a7831ad8686beec9bcd1313b02bc5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b4a7831ad8686beec9bcd1313b02bc5)): ?>
<?php $component = $__componentOriginal9b4a7831ad8686beec9bcd1313b02bc5; ?>
<?php unset($__componentOriginal9b4a7831ad8686beec9bcd1313b02bc5); ?>
<?php endif; ?>
                    <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>

        <h2 class="font-bold text-2xl text-center lg:text-left text-green-600">
            Rp. <?php echo e(number_format($price, 0, ',', '.')); ?>/Bulan
        </h2>

        <hr class="w-full h-0.5 bg-gray-300" />

        <div class="space-y-4">
            <div>
                <h3 class="font-semibold text-lg">Description</h3>
                <p class="text-gray-600"><?php echo e($room[0]['description']); ?></p>
            </div>

            <div>
                <h3 class="font-semibold text-lg">Fasilitas</h3>
                <p class="text-gray-600"><?php echo e($facility); ?></p>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Reviews Section -->
<div class="w-11/12 mx-auto my-10">
    <h3 class="font-semibold text-lg text-center">Reviews</h3>
    <div class="space-y-4">
        <!-- <?php if(isset($rentedRoom)): ?>
                <form action="/rating/room/<?php echo e($room[0]['id']); ?>?userid=<?php echo e(auth()->user()->id ?? null); ?>"
                    method="POST">
                    <?php echo csrf_field(); ?>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Give
                        Review</label>
                    
                    <div class="flex flex-col w-1/5">
                        <label for="star">Star :</label>
                        <input type="number" placeholder="5" id="star" name="star" max="5"
                            class="my-2 rounded-md" />
                    </div>
                    <textarea id="message" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your reviews here..." name="review"></textarea>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 mt-4 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Send</button>
                </form>
            <?php endif; ?> -->
        <?php if(!isset($review[0])): ?>
        <div class="border p-4 flex justify-center items-center rounded-md shadow-sm">
            <h1 class="font-bold text-2xl my-5">Tidak ada review</h1>
        </div>
        <?php endif; ?>
        <?php $__currentLoopData = $review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($item->review)): ?>
        <figure class="w-full shadow-lg p-5">
            <div class="flex items-center mb-4 text-yellow-300">
                <?php for($i = 1; $i <= $item->star; $i++): ?>
                    <?php if (isset($component)) { $__componentOriginal9b4a7831ad8686beec9bcd1313b02bc5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b4a7831ad8686beec9bcd1313b02bc5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.star','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('star'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b4a7831ad8686beec9bcd1313b02bc5)): ?>
<?php $attributes = $__attributesOriginal9b4a7831ad8686beec9bcd1313b02bc5; ?>
<?php unset($__attributesOriginal9b4a7831ad8686beec9bcd1313b02bc5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b4a7831ad8686beec9bcd1313b02bc5)): ?>
<?php $component = $__componentOriginal9b4a7831ad8686beec9bcd1313b02bc5; ?>
<?php unset($__componentOriginal9b4a7831ad8686beec9bcd1313b02bc5); ?>
<?php endif; ?>
                    <?php endfor; ?>
            </div>
            <blockquote>
                <p class="text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e($item->review); ?></p>
            </blockquote>
            <figcaption class="flex items-center mt-6 space-x-3 rtl:space-x-reverse">
                <img class="w-6 h-6 rounded-full" src="https://placehold.co/100x100" alt="profile picture">
                <div
                    class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-300 dark:divide-gray-700">
                    <cite class="pe-3 font-medium text-gray-900 dark:text-white"><?php echo e($item->name); ?></cite>
                </div>
            </figcaption>
            <cite
                class="pe-3 mt-3 font-medium text-gray-900 dark:text-white"><?php echo e(Carbon::parse($item->created_at)->translatedFormat('l, j F Y')); ?></cite>
        </figure>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php else: ?>
<h1 class="font-bold text-3xl text-center flex w-full h-screen justify-center items-center">Room Tidak Ditemukan
</h1>
<?php endif; ?><?php /**PATH /home/syafiq/codingan/ayongekost/resources/views/room/room-details.blade.php ENDPATH**/ ?>