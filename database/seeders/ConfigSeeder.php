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
            'key' => 'message_categories',
            'value'=>'[{"value":"public","label":"Public"},{"value":"member","label":"Members"},{"value":"personal","label":"Personal"}]',
        ]);

    }


}
