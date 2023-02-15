<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'key' => 'room_status',
            'value' => '[{"value":"AVAILABLE","label":"可用"},{"value":"MAINTENACE","label":"維修中"},{"value":"CLOSED","label":"不開放"}]',
        ]);
        DB::table('configs')->insert([
            'key' => 'room_types',
            'value' => '[{"value":"REGULAR","label":"一般教室"},{"value":"COMPUTER","label":"電腦室"},{"value":"HALL","label":"禮堂"}]',
        ]);
    }
}
