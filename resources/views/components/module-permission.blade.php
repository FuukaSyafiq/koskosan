@props(['name' => "", "role" => "", "description" => ""])


<div id="komplain" class="max-w-sm mx-auto bg-white shadow-lg rounded-lg p-6 mt-4">
    <div class="text-center mb-4 relative flex justify-between items-center">
        <h2 class="text-lg w-3/5 text-wrap font-semibold flex-grow">{{$description}}</h2>
        <button type="button" class="bg-red-500 text-white absolute right-1 text-sm py-1 px-3 rounded hover:bg-red-600"
            onclick="deletePermissionName('<?php echo $name ?>')">X</button>
    </div>

    <div class="flex flex-col items-center">
        <div>
            <div class="flex w-full items-center justify-around">
                <div class="flex flex-col justify-center items-center m-1">
                    <label for="create" class="block">CREATE</label>
                    <input type="checkbox" class="mt-2"
                        onclick="changePermission(event,'<?= $role ?>', '<?= $name ?>', 'CREATE')"
                        {{\App\Models\Permission::isAllowed($role, $name, "CREATE") ? 'checked' : ''}}>
                </div>

                <div class="flex flex-col justify-center items-center m-1">
                    <label for="read" class="block">READ</label>
                    <input type="checkbox" class="mt-2"
                        onclick="changePermission(event,'<?= $role ?>', '<?= $name ?>', 'READ')"
                        {{\App\Models\Permission::isAllowed($role, $name, "READ") ? 'checked' : ''}}>
                </div>
                <div class="flex flex-col justify-center items-center m-1">
                    <label for="update" class="block">UPDATE</label>
                    <input type="checkbox" class="mt-2"
                        onclick="changePermission(event,'<?= $role ?>','<?= $name ?>', 'UPDATE')"
                        {{\App\Models\Permission::isAllowed($role, $name, "UPDATE") ? 'checked' : ''}}>
                </div>
                <div class="flex flex-col justify-center items-center m-1">
                    <label for="delete" class="block">DELETE</label>
                    <input type="checkbox" class="mt-2"
                        onclick="changePermission(event,'<?= $role ?>' ,'<?= $name ?>', 'DELETE')"
                        {{\App\Models\Permission::isAllowed($role, $name, "DELETE") ? 'checked' : ''}}>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    async function request(role, module, action, method) {
        try {

            const response = await fetch(`/dashboard/permissionManager`, {
                method,
                body: JSON.stringify({
                    role,
                    module,
                    action
                }),
                headers: {
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })

            if (response.status == 200) {
                return response.json();
            }
        } catch (error) {
            console.log(error, "ini error")
        }
    }


    async function changePermission(e, role, module, action) {
        if (e.target.checked == false) {
            const data = await request(role, module, action, "DELETE");
            console.log(data);
            return;
        };
        const data = await request(role, module, action, "PATCH");
        console.log(data);
    }

    async function deletePermissionName(permissionName) {
        const result = await fetch("/permission", {
            method: "DELETE",
            body: JSON.stringify({
                name: permissionName
            }),
            headers: {
                'Content-type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })

        if (result.ok) {
            location.reload();
        }
        const data = await result.json()
        console.log(data);
    }
</script>