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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('scope')->nullable();
            $table->string('name_zh');
            $table->string('name_en')->nullable();
            $table->text('description_zh')->nullable();
            $table->text('description_en')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('number')->nullable();
            $table->longText('class_time')->nullable();
            $table->integer('hours')->nullable();
            $table->integer('fee')->nullable();
            $table->integer('fee_member')->nullable();
            $table->integer('quota')->nullable();
            $table->longText('content')->nullable();
            $table->string('language')->nullable();
            $table->string('location')->nullable();
            $table->longText('target')->nullable();
            $table->longText('tutor')->nullable();
            $table->text('poster_path')->nullable();
            $table->boolean('published')->default(0);
            $table->boolean('member_priority')->default(0);
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
        Schema::dropIfExists('courses');
    }
};
