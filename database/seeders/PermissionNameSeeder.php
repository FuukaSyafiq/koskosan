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
			["name" => "Room", "action" => "CREATE"],
			["name" => "Room", "action" => "READ"],
			["name" => "Room", "action" => "DELETE"],
			["name" => "Room", "action" => "UPDATE"],
			["name" => "User", "action" => "CREATE"],
			["name" => "User", "action" => "READ"],
			["name" => "User", "action" => "DELETE"],
			["name" => "User", "action" => "UPDATE"],
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
