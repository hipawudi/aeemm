<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'title_zh' => '水技術提升培訓課程',
            'title_en' => 'Advancement of Water Technology Course',
            'scope'=>'機電工程, 機械工程',
            'description_zh'=>'水與我們日常生活息息相關,而水處理技術的發展更是與日俱新,本課程透過了解不同的水處理技術、標準與法規,管理技術,以及監察控制系統,並透過短片、產品展示,助學員明白水處理的理念及過程,使學員能在完成課程後掌握水技術並提升對水資源的管理及技術應用。',
            'start_date'=>'2023-03-25',
            'hours'=>'4',
            'fee'=>'680',
            'fee_member'=>'560',
            'quota'=>'0',
            'content'=>'Treatment 處理
            ➢ Backwash Pre-filter 前置過濾<br>
            ➢ Point of Use Purification 末端淨水<br>
            ➢ Water softening 軟水處理<br>
            ➢ Disinfection 殺菌消毒<br>
            </p>
            <p>Management 管理<br>
            ➢ Backflow prevention 防污隔斷<br>
            ➢ Leakage protection 防漏保護<br>
            ➢ Hygiene precaution 衛生防護<br>
            </p>',
            'language'=>'zh',
            'location'=>'',
            'tutor'=>'陳弘基 工程師陳弘基工程師於 1993 年畢業於英國諾桑比亞大學,獲得屋宇設備工程學學士學位,於2002年於香港大學取得屋宇設備工程學碩士學位,2006年取得中國人民大學法學碩士。陳弘基工程師為英國皇家特許工程師、英國消防工程師學會會員,以及英國營運工程師學會資深會員。於過去曾擔任多間大型公司的項目負責人,現時為創科實力有限公司的總經理。',
            'published'=>'1',
        ]);


    }
}
