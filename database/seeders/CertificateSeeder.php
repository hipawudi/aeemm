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
            'cert_title' => '機電工程資格認證',
            'cert_body' => '澳門機電工程師學會',
            'cert_content' => '此證書證明閣下已通過澳門機電工程師學會機電工程資格認證',
            'number_format'=> 'CERT-',
            'description' => '澳門機電工程資格認證'
        ]);

        DB::table('professionals')->insert([
            'certificate_id' => '1',
            'member_id' => '1',
            'display_name' => '管理員',
            'number_display' => 'CERT-0001',
            'issue_date' => '2023-01-01',
            'valid_from' => '2023-01-01',
            'valid_until' => '2024-12-31',
            'authorize_by' => '管理員',
            'rank' => '1',
        ]);
    }
}
