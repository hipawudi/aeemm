<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forms')->insert([
            'title' => '水技術提升培訓課程',
            'published' => false,
            'course_id' => '1',
        ]);
        DB::table('form_fields')->insert([
            'form_id' => '1',
            'field_label' => 'Username',
            'type' => 'input'
        ]);
        DB::table('form_fields')->insert([
            'form_id' => '1',
            'field_label' => 'Gender',
            'type' => 'radio',
            'options' => '[{"value":"M","label":"Male"},{"value":"F","label":"Female"}]'
        ]);
        DB::table('form_fields')->insert([
            'form_id' => '1',
            'field_label' => 'DOB',
            'type' => 'date',
        ]);
        DB::table('form_fields')->insert([
            'form_id' => '1',
            'field_label' => 'Education',
            'type' => 'select',
            'options' => '[{"value":"B","label":"Bachalor"},{"value":"M","label":"Master"},{"value":"D","label":"PhD."}]'
        ]);
        DB::table('form_fields')->insert([
            'form_id' => '1',
            'field_label' => 'Email',
            'type' => 'email'
        ]);
        DB::table('form_fields')->insert([
            'form_id' => '1',
            'field_label' => 'Remark',
            'type' => 'textarea'
        ]);
        DB::table('forms')->insert([
            'title' => '屋宇電氣系統設計課程2023',
            'published' => false,
            'course_id' => '2',
        ]);
        DB::table('form_fields')->insert([
            'form_id' => '2',
            'field_label' => 'Username',
            'type' => 'input',
        ]);
    }
}
