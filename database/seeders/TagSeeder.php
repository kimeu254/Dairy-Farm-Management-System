<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $now = Carbon::now();
        DB::table('tags')->insert([
            'title' => 'Milk Sale',
            'slug' => 'milksale',
            'status' => 'Active',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('tags')->insert([
            'title' => 'Medication',
            'slug' => 'medication',
            'status' => 'Active',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('tags')->insert([
            'title' => 'Inventory',
            'slug' => 'inventory',
            'status' => 'Active',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
