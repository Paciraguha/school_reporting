<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ClassLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('class_levels')->insert([
            ['levels' => 'Nusery', 'created_at' => $now, 'updated_at' => $now],
            ['levels' => 'Primary', 'created_at' => $now, 'updated_at' => $now],
            ['levels' => 'Secondary', 'created_at' =>$now, 'updated_at' => $now],
            ['levels' => 'TVET', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
