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
            'value' => '
            [{"value":"public","label":"所有人"},
            {"value":"member","label":"會員"},
            {"value":"personal","label":"個人"}
            ]',
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
                    "value": "活動訊息",
                    "label": "活動訊息"
                },{
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

        DB::table('configs')->insert([
            'key' => 'application_states',
            'value' => '[{
                "value":"0",
                "label":"待審批"
            },{
                "value":"1",
                "label":"待繳費"
            },{
                "value":"2",
                "label":"待確認"
            },{
                "value":"3",
                "label":"已完成"
            },{
                "value":"4",
                "label":"已拒絕"
            }]'
        ]);

        DB::table('configs')->insert([
            'key' => 'states_messages',
            'value' => '[{
                "value":"0",
                "label":"已提交報名申請，請等待工作人員審批。"
            },{
                "value":"1",
                "label":"報名申請已通過，請繳交課程費用並上傳繳費單。"
            },{
                "value":"2",
                "label":"已上傳繳費單，請等待工作人員審核。"
            },{
                "value":"3",
                "label":"恭喜你已成功完成報名，請按照課程的上課時間和地點上課。"
            },{
                "value":"4",
                "label":"抱歉此報名被拒絕。"
            }]'
        ]);
    }
}
