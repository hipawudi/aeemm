<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name_zh');
            $table->string('name_en');
            $table->text('gender');
            $table->text('photo_path')->nullable();
            $table->date('birth');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('company');
            $table->string('position');
            $table->text('membership_level');
            $table->text('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mebmer_application');
    }
};
