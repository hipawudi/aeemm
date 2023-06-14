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
        // for ($i = 0; $i < 50; $i++) {
        DB::table('courses')->insert([
            'name_zh' => '水技術提升培訓課程',
            'name_en' => 'Advancement of Water Technology Course',
            'scope' => '機電工程, 機械工程',
            'description_zh' => '水與我們日常生活息息相關,而水處理技術的發展更是與日俱新,本課程透過了解不同的水處理技術、標準與法規,管理技術,以及監察控制系統,並透過短片、產品展示,助學員明白水處理的理念及過程,使學員能在完成課程後掌握水技術並提升對水資源的管理及技術應用。',
            'start_date' => '2023-03-05',
            'end_date' => '2023-03-19',
            'class_time' => '2023年03月25日, 09:00am – 13:00pm',
            'hours' => '4',
            'fee' => '680',
            'fee_member' => '560',
            'quota' => '0',
            'number' => '157/FC/2022',
            'content' => 'Treatment 處理<br>
                ➢ Backwash Pre-filter 前置過濾<br>
                ➢ Point of Use Purification 末端淨水<br>
                ➢ Water softening 軟水處理<br>
                ➢ Disinfection 殺菌消毒<br>
                Management 管理<br>
                ➢ Backflow prevention 防污隔斷<br>
                ➢ Leakage protection 防漏保護<br>
                ➢ Hygiene precaution 衛生防護<br>
                ',
            'language' => '粵語',
            'location' => '澳門羅理基博士大馬路 600 號 E,第一國際商業中心,1505 室',
            'target' => '工程師,設計顧問 <br> ※ 澳門機電工程師學會會員優先報讀 ※',
            'tutor' => '陳弘基 工程師 <br> 陳弘基工程師於 1993 年畢業於英國諾桑比亞大學,獲得屋宇設備工程學學士學位,於2002年於香港大學取得屋宇設備工程學碩士學位,2006年取得中國人民大學法學碩士。陳弘基工程師為英國皇家特許工程師、英國消防工程師學會會員,以及英國營運工程師學會資深會員。於過去曾擔任多間大型公司的項目負責人,現時為創科實力有限公司的總經理。',
            'published' => '1',
        ]);
        DB::table('courses')->insert([
            'name_zh' => '屋宇電氣系統設計課程2023',
            'name_en' => 'Building’s Electric Design Course 2023',
            'scope' => '多範疇內容的補充進修',
            'description_zh' => 'The Building’s Electric Design Course consists of concepts of calculations and project design, this training course will be delivered in two parts, i.e. Part 1 - Sizing Electrical Installation in LV and Part II - Building’s Electric Design. Lecturer will present practical exercises and case study to demonstrate the steps of electrical system design of a building. The aim of this course is to let our attendees understand the concept and procedures of electrical system design of a building, and they can carry out preliminary design and perform project analyze after completion of this course.',
            'start_date' => '2023-04-10',
            'end_date' => '2023-04-24',
            'class_time' => '2023年05月03日, 19:30 – 22:30',
            'hours' => '3',
            'fee' => '600',
            'fee_member' => '500',
            'quota' => '0',
            'content' => '
                ➢ Introduction <br>
                ➢ Fundamental Concept<br>
                ➢ Preliminary Calculations<br>
                ➢ Protection of Conductors<br>
                ➢ Exercise1 & 2<br>
                ➢ Electric Design - Constitution of the Project<br>
                ➢ Calculation of Required Power<br>
                ➢ Case Study<br>
                ➢ Other Collective Systems<br> 
                ',
            'language' => 'English',
            'number' => '11/FC/2023',
            'target' => 'Engineers, Designers',
            'location' => 'Webinar Training, Software [ZOOM]',
            'tutor' => 'Mr. Angelo Tavares graduated in Electrical Engineering from Faculdade de Ciências e Tecnlogia Universidade de Coimbra in 1980, holding degree in Electrical Engineering, Network and Power Systems. He joined CEM since 1989, management of MV, LV and PL Network Design, Construction, and Maintenance, also HV Network Construction. Customer Substations and Electrical Connections analyze and design for new and existing buildings. Analyze power increase and other power supply request / design for connection to public network. He also responsible for EV and PV project analyze. Mr. Angelo Tavares has over 30 years experience in building electrical design in Macau.',
            'published' => '1',
        ]);
    }
    // }
}
