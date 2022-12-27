<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // $user = DB::table('users')->insert([
        //     'name' => "Sabbir Hasan",
        //     'email' => 'sabbirshouvo@gmail.com',
        //     'password' => Hash::make('S@bbir12'),
        // ]);
        $user = User::factory()->create([
            'name' => "Sabbir Hasan",
            'email' => 'sabbirshouvo@gmail.com',
            'password' => Hash::make('S@bbir12'),
        ]);
        $user->assignRole('Super-Admin');
    }
}
