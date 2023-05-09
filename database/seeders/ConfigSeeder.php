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
            'value' => '[{"value":"all","label":"所有人"},{"value":"member","label":"會員"},{"value":"personal","label":"個人"}]',
        ]);

        DB::table('configs')->insert([
            'key' => 'bulletin_categories',
            'value' => '
                [{
                    "value": "大事紀要",
                    "label": "大事紀要"
                }, {
                    "value": "媒體報導",
                    "label": "媒體報導"
                }, {
                    "value": "學會消息",
                    "label": "學會消息"
                }, {
                    "value": "專題講座",
                    "label": "專題講座"
                }, {
                    "value": "技術交流",
                    "label": "技術交流"
                }, {
                    "value": "機電小TIPS",
                    "label": "機電小TIPS"
                }, {
                    "value": "進修課程",
                    "label": "進修課程"
                }]
            ',
        ]);
    }
}
