<?php
    $user = auth()->user();
?>

<button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots"
    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 md:hidden" type="button">
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
        <path
            d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
    </svg>
</button>

<!-- Dropdown menu -->
<div id="dropdownDots"
    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <li>
        <a href="<?php echo e(url('/roomlist')); ?>"
            class="block m-auto p-3 font-bold b hover:bg-slate-700 g-slate-700 rounded md:bg-transparent  md:p-0 hover:text-white text-black"
            aria-current="page">List Tipe Kamar</a>
    </li>
    <?php if($user): ?>
        <?php if($user->role_id == \App\Models\Role::getIdByRole('PENYEWA')): ?>
            <li>
                <a href="<?php echo e(url('/penyewa')); ?>"
                    class="block m-auto p-3 font-bold b hover:bg-slate-700 g-slate-700 rounded md:bg-transparent  md:p-0 hover:text-white text-black"
                    aria-current="page">Kamar Anda</a>
            </li>
        <?php endif; ?>

        <?php if($user->role_id == \App\Models\Role::getIdByRole('OWNER')): ?>
            <li>
                <a href="<?php echo e(url('/owner')); ?>"
                    class="block m-auto p-3 font-bold b hover:bg-slate-700 g-slate-700 rounded md:bg-transparent  md:p-0hover:text-white text-black"
                    aria-current="page">Kelola KOS</a>
            </li>
        <?php endif; ?>
        <li>
            <form action="<?php echo e(route('logout')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <a href="<?php echo e(route('logout')); ?>" class="text-black text-center px-4 py-2"
                    onclick="event.preventDefault();                                                                                                                                         this.closest('form').submit();">
                    Logout
                </a>
            </form>
        </li>
    <?php elseif(!$user): ?>
        <li>
            <a href="<?php echo e(url('/denah')); ?>">
                <button id="dropdownDefaultButton" class="text-black text-center px-4 py-2" type="button">Denah
                </button>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('login')); ?>">
                <button id="dropdownDefaultButton" class="text-black text-center px-4 py-2" type="button">Login
                </button>
            </a>
        </li>
        <li>
            <a href="<?php echo e(url('/register')); ?>">
                <button id="dropdownDefaultButton" class="text-black text-center px-4 py-2" type="button">Register
                </button>
            </a>
        </li>
    <?php endif; ?>
    </ul>
</div>
<?php /**PATH /home/syafiq/codingan/ayongekost/resources/views/components/header-sidebar.blade.php ENDPATH**/ ?>