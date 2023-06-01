<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BulletinImage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bulletin_images')->insert([
            'bulletin_id' => '1',
            'image_path' => 'public/images/bulletin/4RFUztr9FivBHQKkhhYs4W6wfmhbJN6ajn9CJTJt.jpg',
        ]);
        DB::table('bulletin_images')->insert([
            'bulletin_id' => '2',
            'image_path' => 'public/images/bulletin/AVOc5TtE5Mn9mEPXcPOnwj0cJOPlBXRWzffG1821.jpg',
        ]);
    }
}
