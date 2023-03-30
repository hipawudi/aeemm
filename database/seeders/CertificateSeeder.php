<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certificates')->insert([
            'name'=>'機電工程資格認證',
            'cert_title'=>'機電工程資格認證',
            'cert_body'=>'澳門機電工程師學會',
            'description'=>'澳門柔道總會裁判資格認證<br><ul><li>aaa</li></ul>'
        ]);
        DB::table('certificates')->insert([
            'name'=>'機電工程資格認證',
            'cert_title'=>'機電工程資格認證',
            'cert_body'=>'澳門機電工程師學會',
            'description'=>'澳門柔道總會裁判資格認證<br><ul><li>aaa</li></ul>'
        ]);

        DB::table('professionals')->insert([
            'certificate_id'=>'1',
            'member_id'=>'1',
            'display_name'=>'梁啓康',
            'number'=>'1',
            'number_display'=>'CERT-0001',
            'issue_date'=>'2023-01-01',
            'valid_from'=>'2023-01-01',
            'valid_until'=>'2024-12-31',
            'authorize_by'=>'梁啓康',
            'rank'=>'1',
        ]);
        DB::table('professionals')->insert([
            'certificate_id'=>'2',
            'member_id'=>'1',
            'display_name'=>'梁啓康',
            'number'=>'2',
            'number_display'=>'CERT-0002',
            'issue_date'=>'2023-02-01',
            'valid_from'=>'2023-02-01',
            'valid_until'=>'2025-12-31',
            'authorize_by'=>'梁啓康',
            'rank'=>'1',
        ]);

    }
}
