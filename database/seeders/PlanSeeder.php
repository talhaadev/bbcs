<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'id' => 1,
                'title' => 'Basic',
                'description' => 'Basic plan with limited features.',
                'price' => 9.99,
            ],
            [
                'id' => 2,
                'title' => 'Standard',
                'description' => 'Standard plan with more features.',
                'price' => 19.99,
            ],
            [
                'id' => 3,
                'title' => 'Premium',
                'description' => 'Premium plan with all features.',
                'price' => 29.99,
            ],
        ]);
    }
}
