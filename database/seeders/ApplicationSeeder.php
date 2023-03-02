<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('applications')->insert([
            // 'student_id' => '1',
            // 'offer_id' => '1',
            // 'apply' => '1',
            // 'price' => '1000',
            // 'admit' => '0',
        ]);
    }
}
