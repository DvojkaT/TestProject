<?php

namespace Database\Seeders;

use App\Domain\Enums\UserRoleEnum;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (UserRoleEnum::values() as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
