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
            'code'=>'CS101',
            // 'area'=>$subject->abbr,
            // 'category'=>$subject->abbr,
            'title_zh'=>'公職考備試課程',
            //'title_en'=>'',
            'description'=>'😍新一期「公職考備試課程」現正招生中！
            課程簡介:
            適用: 260、350、430或以下公職考
            -計量和數字
            -四則混合計算
            -代數應用和方程式
            -圖形和數列
            -實戰試題摸擬
            -銜接完整初、高中內容 
            3月19-31日期間
            逢週二、四、六13:00-15:30',
            'price'=>'2830',
            // 'early_price'=>'',
            // 'member_price'=>'',
            'sessions'=>'6',
            'hours'=>'15',
            'quota'=>'10',
            'discount'=>'二人同行每人优惠$500'
        ]);

        DB::table('courses')->insert([
            'code'=>'BM101',
            // 'area'=>$subject->abbr,
            // 'category'=>$subject->abbr,
            'title_zh'=>'國際商務禮儀課程',
            //'title_en'=>'',
            'description'=>'課程主要學習不同的中西禮儀文化，如何在商業聚會中建立良好第一印象，成為受歡迎的社交能手！
            內容包括：著裝禮儀，商務專業形象禮儀，手機網絡禮儀，送禮禮儀，有禮溝通，商務實務禮儀，商務餐桌禮儀。。。',
            'price'=>'3800',
            // 'early_price'=>'',
            // 'member_price'=>'',
            // 'sessions'=>'',
            // 'hours'=>'',
            'quota'=>'10',
            'discount'=>'二人同行每人減300！
            可用消費卡😊等於再打75折！'
        ]);

        DB::table('courses')->insert([
            'code'=>'IT101',
            // 'area'=>$subject->abbr,
            // 'category'=>$subject->abbr,
            'title_zh'=>'加密貨幣投資入門班',
            //'title_en'=>'',
            'description'=>'加密貨幣投資入門班(比特幣為何值錢?)
            時間: 6月19日晚上18:55-21:55
            內容：
            1. 什麼是區塊鏈技術？
            2. 什麼是去中心化加密貨幣？
            3. 什麼是比特幣，為何值錢？
            4. 澳門人如何買或賣加密貨幣？
            5. 澳門人如何儲存加密貨幣最安全？
            6. 如何使用AI智能機器人量化自動交易？',
            'price'=>'600',
            // 'early_price'=>'',
            // 'member_price'=>'',
            // 'sessions'=>'',
            // 'hours'=>'',
            'quota'=>'10',
            'discount'=>'名額極其有限，請即馬上拿出你的手機，打開你的微信添加：happily987  為好友報名參加
            或發手機信息至手機號:  6567 6701報名'
        ]);
    }
}
