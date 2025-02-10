<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@softui.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]); */
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'name' => 'Profesor User',
            'email' => 'profesor@example.com',
            'password' => Hash::make('password'),
            'role' => 'profesor',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'name' => 'Estudiante User',
            'email' => 'estudiante@example.com',
            'password' => Hash::make('password'),
            'role' => 'estudiante',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
