@php 
    use \App\Models\Role;
    $roles = Role::getAllRole()->where('role', "!=", "WARGA"); // Fetch all roles from the database
@endphp

<x-header />

{{-- Create New Role --}}
<div
    class="w-2/5  p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 mx-auto my-5">
    <form method="POST" class="space-y-6" action="/roles">
        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Tambah role baru</h5>
        @csrf
        <div class="flex items-center space-x-2">
            <label for="nama" class="block text-md font-medium text-gray-900 dark:text-white">role</label>
            <input type="text" name="role" id="nama"
                class="flex-grow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                required />
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambahkan</button>
        </div>
    </form>
</div>

{{-- Role Table --}}
<div class="relative overflow-x-auto mx-auto my-5">
    <table class="w-3/4 text-sm text-left mx-auto rounded-lg">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">Role</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $key => $role)
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $key }}
                    </th>
                    <td class="px-6 py-4">{{ $role->role }}</td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="/dashboard/permissionManager/{{ $role->role }}"
                            class="inline-block bg-blue-500 text-white font-medium py-2 px-4 rounded hover:bg-blue-600">Edit
                            permission</a>
                        <button type="button" onclick="showConfirmationModal('<?php echo $role->role ?>')"
                            class="bg-red-500 text-white font-medium py-2 px-4 rounded hover:bg-red-600">Delete
                            role</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-lg font-semibold mb-4">apakah kamu yakin?</h2>
        <div class="flex justify-end space-x-2">
            <button id="cancelButton" class="bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded">batal</button>
            <button class="bg-red-500 text-white font-medium px-4 py-2 rounded" onclick="deleteRole()">OK</button>
        </div>
    </div>
</div>

<script>
    let roleToDelete = null;

    function showConfirmationModal(role) {
        roleToDelete = role;
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    document.getElementById('cancelButton').addEventListener('click', function () {
        document.getElementById('confirmationModal').classList.add('hidden');
    });

    async function deleteRole() {
    console.log(roleToDelete)
        console.log("terdelete")
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const result = await fetch("/roles", {
            method: "DELETE",
            body: JSON.stringify({
                role: roleToDelete
            }),
            headers: {
                'Content-type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        
        if (result.ok) {
            document.getElementById("confirmationModal").classList.add("hidden");
            location.reload();
        }
        const data = await result.json()
        console.log(data)
    }
</script>