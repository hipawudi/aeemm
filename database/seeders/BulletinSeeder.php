<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BulletinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // for ($i = 0; $i < 50; $i++) {
        DB::table('bulletins')->insert([
            'category' => '學會消息',
            'date' => '2023-05-01',
            'title' => '機電工程師學會出席武漢青年創新教育論壇，重視青年培養傳承',
            'content' => '<p>澳門機電工程師學會監事長鄺偉文及理事周紫華於2023年4月24日，在武漢出席2023海峽兩岸暨港澳青年少年設計思維論壇。</p><p>該論壇由中國機械工程學會、中國機械工程學會(台灣地區)、香港工程師學會、澳門機電工程師學會主辦，湖北省科協、武漢市科協作為支持單位，湖北省青少年科技中心、湖北省機械工程學會、丁漢院士智能製造科普工作室作為承辦單位。吸引來自海峽兩岸和港澳地區80多家單位的120名代表出席，圍繞「培養未來工程創新人才」為主題，旨在交流各地區青少年設計思維培養，以及面向青少年群體科技創新教育的理念與實踐經驗。</p><p>論壇上鄺偉文監事長代表澳門機電工程師學會介紹澳門在國家“十四五”規劃上明確「一中心、一平台、一基地」定位下的優勢、面對的機遇和挑戰。以及介紹橫琴粵澳深度合作區建設總體方案的合作新機遇，大力發展四大產業，讓澳門經濟多元並進。二十大報告將“實施科教興國戰略，強化現代建設人才支撐”作為專章，培養青年科技人才是重要的一環。鄺監事長亦藉着論壇介紹澳門機電工程師學會的背景及宗旨，以及青年培養上的工作，包括近期舉辦的課程培訓及技術參觀交流項目。學會亦將青年骨幹會員送到北京參與「港澳高層次科技人才國情研修班」和杭州「港澳台青年科技人才國情研修班」，不斷提供機會予以青年人多方面發展。青年人是社會的棟樑，國家未來發展的希望。因此，學會在2023年成立青年部，以向年輕一代作出經驗、智慧、技術上的傳承。本次活動帶領理事及青年部委員周紫華出席，亦是培養未來科技工程人才的又一實踐。學會青年部近期亦籌備成立高等院校學生分會，培養下一代年青接班人，指導及提升其組識及領導才能，讓其能更容易銜接工程業界。學會代表亦進入澳門培正中學講授建築設備工程課程，將科教戰略得以實踐，為培養青年科技人才佈下種子。未來學會將組織更多青年培養系列活動，從不同階段向青年着手培養，形成傳承梯隊，建成國家現代建設人才的支撐。</p><p>4月25日，本會亦參與了科技創新教育先進單位，包括武漢市育才小學和沈陽路小學。學校有舉辦科創客走進校園系列活動，學生能自選參加編程、機器人、科技小制作等社團活動，在配合教育“雙減”中做到科學教育加法，激發青少年求知欲。學校激勵學生多參與科技創新項目，其間有幼、小、中學生展示了其科創成果，以培育更多青年投身科技事業。</p><p>學會理事及青年部委員周紫華參與本次交流活動後表示大受震撼及獲益良多，除了感慨內地的發展速度，對於科技教育上的前瞻性亦大為欣賞。如設計思維培養上的授課，他認為能夠刺激學生從生活上的觀察及點滴中得到啟發，令科普教育得以有趣味地進行。而且學校對於科技教育能夠與時並進，連近期興起的ChatGPT的應用，亦能夠在校園的科普活動中可以見到，讓學生有途徑對於社會上新興的科技產物獲得一定認識。他認為相關方式學會可以借鑒，在未來學會進行的科普教育活動上將相關思維及形式得以融入，創造出更好的科普教育效果。旅程上亦得到很多來自監事長的經驗和智慧傳授，同時亦得到很多鼓舞。周理事十分欣賞和讚同該傳承方式，認為這種年長幹事帶領青年幹事的出席交流形式應持續進行，讓寶貴的經驗和學會的精神得以延續下去。澳門機電工程師學會提供了相互交流和學習的平臺，讓會員擴展了在工程領域的技術視野，並且切實更新相關的技術知識。未來本會將舉辦不同的培訓及技術參觀活動，為培訓本澳工程師及培育年青工程師作出努力。</p>',
            'description' => '澳門機電工程師學會監事長鄺偉文及理事周紫華於2023年4月24日，在武漢出席2023海峽兩岸暨港澳青年少年設計思維論壇。',
            'cover_image_path' => 'public/images/bulletin/q6swfR7GxBMrbxoUSvAEgEmX6CFUWp2Zh9wKKkcG.jpg',
            'published' => '1',
            'created_by' => '1',
            'updated_by' => '1',
        ]);
        DB::table('bulletins')->insert([
            'category' => '活動訊息',
            'date' => '2023-04-19',
            'title' => '永利皇宮表演湖及觀光纜車機電系統技術參觀提升技術眼界',
            'content' => '<p>由澳門機電工程師學會主辦、永利澳門協辦的「技術參觀-永利皇宮表演湖及觀光纜車機電系統」，於上月25日成功舉行。參觀活動吸引一眾本澳機電工程師的參與，讓他們有機會深入瞭解本澳大型表演湖及觀光纜車相關機電系統的運作。<br>
            本次技術參觀獲永利皇宮設施行政總監 Trevor Cam 先生及表演設施副總監蔡子寧先生、Angelo Vasco 先生的熱情接待。首先介紹了觀光纜車的運作以及有關機電系統，在參觀過程中，參觀學員深入了解到觀光纜車的構造、運作原理、安全措施和維護方式，並且聽取了相關的技術解說和運作模式講解。隨後，參觀學員前往參觀永利皇宮世界級水準的特技效果的綜合設施—表演湖，在欣賞完美妙的表演後，參觀學員更有機會深入了解當中各項效果背後的技術及其操作，在表演設施副總監蔡子寧先生、Angelo Vasco 先生的專業解說下，參觀學員對表演湖各機電系統的技術細節、用途及操作方式有了更清晰及深入的了解。
            此次澳門機電工程師學會的技術參觀活動，為本澳機電工程師提供了相互交流和學習的平臺，讓參觀學員擴展了在工程領域的技術視野，並且切實更新相關的技術知識。未來本會將舉辦不同的技術參觀活動，為培訓本澳工程師及培育年青工程師作出努力。</p>',
            'description' => '由澳門機電工程師學會主辦、永利澳門協辦的「技術參觀-永利皇宮表演湖及觀光纜車機電系統」，於上月25日成功舉行。參觀活動吸引一眾本澳機電工程師的參與，讓他們有機會深入瞭解本澳大型表演湖及觀光纜車相關機電系統的運作。',
            'cover_image_path' => 'public/images/bulletin/bwYT09tuH19RTGCVLkYmZpXl4JGillLywI4tcXvT.jpg',
            'published' => '1',
            'created_by' => '1',
            'updated_by' => '1',
        ]);
        // }
    }
}