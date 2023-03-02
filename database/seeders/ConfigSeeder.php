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
            'key' => 'room_states',
            'value' => '[{"value":"AVAILABLE","label":"可用"},{"value":"MAINTENACE","label":"維修中"},{"value":"CLOSED","label":"不開放"}]',
        ]);
        DB::table('configs')->insert([
            'key' => 'room_types',
            'value' => '[{"value":"REGULAR","label":"一般教室"},{"value":"COMPUTER","label":"電腦室"},{"value":"HALL","label":"禮堂"}]',
        ]);
        DB::table('configs')->insert([
            'key' => 'employment_states',
            'value' => '[{"value":"HIRED","label":"僱用"},{"value":"FIRED","label":"解僱"}]',
        ]);
        DB::table('configs')->insert([
            'key' => 'id_types',
            'value' => '[{"value":"BIRM","label":"澳門居民身份證"},{"value":"HK","label":"香港居民身份證"},{"value":"CHINA","label":"中國居民身份證"},{"value":"PASSWORD","label":"護照"},{"value":"OTHER","label":"其它證件類型"}]',
        ]);
    }
}
