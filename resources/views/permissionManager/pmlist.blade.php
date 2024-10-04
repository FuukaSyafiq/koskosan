@php
    $datas = \App\Models\PermissionName::getAllModules();
@endphp

<x-header />


{{-- pop-up modal --}}
<div id="popup-modal" tabindex="-1"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                onclick="closeModal()">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <h3 id="modal-message" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400 mt-3">
                </h3>
                <button type="button"
                    class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                    onclick="closeModal()">OK</button>
            </div>
        </div>
    </div>
</div>

{{-- Render the 'module permission' --}}
<div
    class="mx-auto flex flex-col p-6 bg-white mt-5 border border-gray-200 rounded-lg flex max-w-7xl justify-around mb-3">
    <div class="flex items-center justify-between">
        <a href="/dashboard/permissionManager/pmrole"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Kembali
        </a>
    </div>
    <h1 class="text-3xl py-2 font-semibold flex-1 text-center">Role {{ $role }}</h1>

    {{-- Tambah Permission Name --}}
    <div
        class="w-2/5 mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 mx-auto my-5">
        <form method="POST" class="space-y-7" action="/permission">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Tambah Permission</h5>
            @csrf
            <div class="flex items-center space-x-2">
                <label for="nama" class="block text-md font-medium text-gray-900 dark:text-white">Tambah</label>
                <input type="text" name="name" id="name"
                    class="flex-grow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required />
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambahkan</button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-3 gap-4 text-center">
        @foreach ($datas as $data)
                <x-module-permission :name="$data->name" :role="$role" :description="$data->description ? $data->description : $data->name" />
        @endforeach
    </div>
</div>

<script>
    function openModal(message) {
        const modal = document.getElementById('popup-modal');
        document.getElementById('modal-message').innerText = message;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('popup-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    async function changePermission(e, role, module, action) {
        let method = e.target.checked ? "PATCH" : "DELETE";
        const data = await request(role, module, action, method);

        let actionText = e.target.checked ? "allowed" : "deleted";
        let message = `${action} permission of ${module} is ${actionText}`;

        openModal(message);
        console.log(data);
    }

</script>