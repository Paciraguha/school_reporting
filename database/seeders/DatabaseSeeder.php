<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'firstName' => 'Iraguha',
            'lastName' => 'Iraguha',
            'Telephone' => '0789112425',
            'position'=>'DEO',
            'email' => 'isp@example.com',
            'Gender'=>"Male"
        ]);
         
        
    }
}
