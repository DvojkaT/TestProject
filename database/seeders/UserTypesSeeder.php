<?php

namespace Database\Seeders;

use App\Domain\Enums\TypeEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (TypeEnum::values() as $type) {
            DB::table('user_types')->updateOrInsert(['type' => $type]);
        }
    }
}
