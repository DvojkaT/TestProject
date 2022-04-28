<?php

namespace Database\Seeders;

use App\Domain\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        foreach (UserRoleEnum::values() as $role) {
            Role::firstOrCreate(['name' => $role, 'display_name' => $role]);
        }
    }
}
