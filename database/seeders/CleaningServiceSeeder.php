<?php

namespace Database\Seeders;

use App\Models\CleaningService;
use Illuminate\Database\Seeder;

class CleaningServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CleaningService::factory()->count(5)->create();
    }
}
