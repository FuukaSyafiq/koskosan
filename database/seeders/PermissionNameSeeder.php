<?php

namespace Database\Seeders;

use App\Models\PermissionName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionNameSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		$datas = [
			["name" => "DASHBOARDGRAFIK", "action" => "CREATE"],
			["name" => "DASHBOARDGRAFIK", "action" => "READ"],
			["name" => "DASHBOARDGRAFIK", "action" => "DELETE"],
			["name" => "DASHBOARDGRAFIK", "action" => "UPDATE"],
		];


		foreach ($datas as $value) {
			PermissionName::create($value);
		}
	}
	public static function down()
	{
		PermissionName::query()->delete();
	}
}
