<?php

namespace Database\Seeders;

use App\Models\CleaningHistory;
use Illuminate\Database\Seeder;

class CleaningHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CleaningHistory::factory()->count(5)->create();
    }
}
