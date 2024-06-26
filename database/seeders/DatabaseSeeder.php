<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        User::create([
            'name' => 'OTI FCCTP',
            'email' => 'oti_fcctp@usmp.pe',
            'password' => Hash::make('oldmanmin2')
        ]);

        User::create([
            'name' => 'UNIDAD DE CALIDAD',
            'email' => 'ucalidad_fcctp@usmp.pe',
            'password' => Hash::make('Isometrik24')
        ]);

        //$this->call(MenuOptionSeeder::class);
    }
}
