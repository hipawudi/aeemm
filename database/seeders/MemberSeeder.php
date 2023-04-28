<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'name_zh' => '管理員',
            'display_name' => '管理員',
            'email' => 'admin@example.com',
            'state' => 1,
        ]);
        DB::table('members')->insert([
            'name_zh' => '成員',
            'display_name' => '成員',
            'email' => 'mebmer@example.com',
            'state' => 1,
        ]);
        DB::table('members')->insert([
            'name_zh' => '曾文安',
            'display_name' => '曾文安',
            'state' => 1,
        ]);
        DB::table('members')->insert([
            'name_zh' => '鄧智欣',
            'display_name' => '鄧智欣',
            'state' => 1,
        ]);
        DB::table('members')->insert([
            'name_zh' => '陳佳熙',
            'display_name' => '陳佳熙',
            'state' => 1,
        ]);
        DB::table('members')->insert([
            'name_zh' => '鍾建輝',
            'display_name' => '鍾建輝',
            'state' => 1,
        ]);
        // DB::table('member_user')->insert([
        //     'member_id'=>'1',
        //     'user_id'=>'1',
        // ]);
        DB::table('members')->where('id', 1)->update(['user_id' => 1]);
        DB::table('members')->where('id', 2)->update(['user_id' => 2]);
    }
}
