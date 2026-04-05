<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['user' => auth()->user()]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['user' => auth()->user()]); ?>
<?php foreach (array_filter((['user' => auth()->user()]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>AyoNgekost</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="https://tenor.com/id/view/black-hot-mafia-kardiya-gif-25072254" type="image/png" />
    <style>
    </style>
 <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
<?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
</head>
<style>
body {
    background: #EEEEEE;
}

/* remove 'input type number' arrow*/
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    display: none;
    margin: 0;
}
</style>

<nav class="w-full mt-2 border-gray-200 dark:bg-gray-900 rounded-md text-white">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
        <a href="<?php echo e(route('index')); ?>" class="flex w-1/5 items-center">
            <span class="self-center text-2xl text-lime-600 font-semibold whitespace-nowrap ml-1"><?php echo e(config('app.name')); ?></span>
        </a>

        
        <?php if (isset($component)) { $__componentOriginal5933eef65548e50e679d4f8acbf21140 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5933eef65548e50e679d4f8acbf21140 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header-sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header-sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5933eef65548e50e679d4f8acbf21140)): ?>
<?php $attributes = $__attributesOriginal5933eef65548e50e679d4f8acbf21140; ?>
<?php unset($__attributesOriginal5933eef65548e50e679d4f8acbf21140); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5933eef65548e50e679d4f8acbf21140)): ?>
<?php $component = $__componentOriginal5933eef65548e50e679d4f8acbf21140; ?>
<?php unset($__componentOriginal5933eef65548e50e679d4f8acbf21140); ?>
<?php endif; ?>

        <div class="hidden w-4/5 md:flex  justify-end items-center" id="navbar-default">
            <ul class="mr-1 font-medium justify-end w-full items-center flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="<?php echo e(url('/roomlist')); ?>">
                        <button id="dropdownDefaultButton" class="text-white bg-lime-400 hover:bg-lime-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">List Tipe Kamar
                        </button>
                    </a>
                </li>
                <?php if($user): ?>
                <?php if($user->role_id == \App\Models\Role::getIdByRole('PENYEWA')): ?>
                <li>
                    <a href="<?php echo e(url('/penyewa')); ?>" class="text-white bg-lime-400 hover:bg-lime-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" aria-current="page">Kamar Anda</a>
                </li>
                <?php endif; ?>

                <?php if($user->role_id == \App\Models\Role::getIdByRole('OWNER')): ?>
                <li>
                    <a href="<?php echo e(url('/owner')); ?>" class="text-white bg-lime-400 hover:bg-lime-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" aria-current="page">Kelola KOS</a>
                </li>
                <?php endif; ?>

                <!-- user profile start -->
                <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <button type="button" class="flex text-sm bg-white rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 border-solid border-2 border-gray-950" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="/assets/images/profile.svg" alt="user photo">
                    </button>
                    <!-- Dropdown menu -->
                    <div class="bg-amber-100 z-50 hidden my-4 text-base list-none    divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-md text-gray-900 dark:text-white"><?php echo e(Auth::user()->name); ?></span>
                            <span class="block text-md  text-gray-500 truncate dark:text-gray-400"><?php echo e(Auth::user()->email); ?></span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <form action="<?php echo e(route('logout')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <a href="<?php echo e(route('logout')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" onclick="event.preventDefault();                                                                                                                                         this.closest('form').submit();">
                                        Logout
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- user profile end -->
                <?php elseif(!$user): ?>
                <li>
                    <a href="<?php echo e(url('/denah')); ?>">
                        <button id="dropdownDefaultButton" class="text-white bg-lime-400 hover:bg-lime-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Denah
                        </button>
                    </a>

                </li>
                <li>

                    <a href="<?php echo e(route('login')); ?>">
                        <button id="dropdownDefaultButton" class="text-white bg-lime-400 hover:bg-lime-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Login
                        </button>
                    </a>

                </li>
                <li>
                    <a href="<?php echo e(url('/register')); ?>">
                        <button id="dropdownDefaultButton" class="text-white bg-lime-400 hover:bg-lime-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Register
                        </button>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav><?php /**PATH /home/syafiq/codingan/ayongekost/resources/views/components/header.blade.php ENDPATH**/ ?>