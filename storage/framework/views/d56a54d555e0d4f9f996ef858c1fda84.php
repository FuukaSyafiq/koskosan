<?php
    use App\Models\Review;
    use Illuminate\Support\Facades\Storage;
    // $averageStar = Review::getAverageStarForRoom($data->id);
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'data' => [
        'id' => '',
        'tipe' => '',
        'price' => '',
        'facility' => '',
        'ukuran' => '',
        'path' => '',
    ],
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'data' => [
        'id' => '',
        'tipe' => '',
        'price' => '',
        'facility' => '',
        'ukuran' => '',
        'path' => '',
    ],
]); ?>
<?php foreach (array_filter(([
    'data' => [
        'id' => '',
        'tipe' => '',
        'price' => '',
        'facility' => '',
        'ukuran' => '',
        'path' => '',
    ],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$imageUrl = $data->image ? Storage::disk('s3')->url($data->image) : asset('images/no-image.png');
?>

<div class="m-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="/tiperoom/<?php echo e($data->id); ?>">
        <img class="p-4 rounded-t-lg object-cover w-full h-72" src="<?php echo e($imageUrl); ?>" alt="product image" />
        <div class="p-5 flex flex-col h-40">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white flex-1"><?php echo e($data->tipe); ?>

            </h5>
            <div class="flex items-center mt-2.5 mb-2">
                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                    
                </div>
                
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xl font-bold text-gray-900 dark:text-white price" data-price="<?php echo e($data->price); ?>">
                    <?php echo e("Rp. " .number_format($data->price, 0, ',', '.')); ?></span>
            </div>
        </div>
    </a>
</div>
<?php /**PATH /home/syafiq/codingan/ayongekost/resources/views/components/tiperoom.blade.php ENDPATH**/ ?>