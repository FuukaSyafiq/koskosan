<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionName;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                "role_id" => Role::getIdByRole("OPERATOR"),
                "permission_name_id" => PermissionName::getIdByPermissionNameAndAction("DATAUSER", "CREATE")
            ],
        ];

        foreach ($datas as $data) {
            Permission::create($data);
        }
    }

    public static function down()
    {
        Permission::where('role_id', Role::getIdByRole("OPERATOR"))->delete();
    }
}
