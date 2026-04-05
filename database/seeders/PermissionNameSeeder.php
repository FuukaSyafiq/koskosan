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
			["name" => "Room", "action" => "VIEWPAGE"],
			["name" => "User", "action" => "CREATE"],
			["name" => "User", "action" => "READ"],
			["name" => "User", "action" => "DELETE"],
			["name" => "User", "action" => "UPDATE"],
			["name" => "User", "action" => "VIEWPAGE"],
			["name" => "User", "action" => "ACCESS"],
			["name" => "Rented Room", "action" => "UPDATE"],
			["name" => "Rented Room", "action" => "READ"],
			["name" => "Rented Room", "action" => "CREATE"],
			["name" => "Rented Room", "action" => "DELETE"],
			["name" => "Rented Room", "action" => "VIEWPAGE"],
			["name" => "Rented Room", "action" => "ACCESS"],
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
