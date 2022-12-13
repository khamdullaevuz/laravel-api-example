<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jobs;
use App\Models\Works;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Jobs::factory()->count(10)->create();
        Jobs::factory()->count(10)->create();
    }
}
