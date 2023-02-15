<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('password'),
        // ]);
        \App\Models\User::factory([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password'=> Hash::make('password')
        ])->withPersonalTeam()->create();

        $this->call([
            CourseSeeder::class,
            OfferSeeder::class,
            RoomSeeder::class,
        ]);

    }
}
