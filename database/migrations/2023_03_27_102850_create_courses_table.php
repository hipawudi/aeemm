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
            $table->string('title_zh');
            $table->string('title_en')->nullable();
            $table->text('description_zh')->nullable();
            $table->text('description_en')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('class_time')->nullable();
            $table->integer('fee')->nullable();
            $table->longText('content')->nullable();
            $table->string('language')->nullable();
            $table->string('location')->nullable();
            $table->string('target')->nullable();
            $table->longText('tutor')->nullable();
            $table->boolean('published')->default(0);
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
