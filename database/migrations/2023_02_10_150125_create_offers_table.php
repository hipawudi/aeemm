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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id');
            $table->string('subset');
            $table->string('title_zh');
            $table->string('title_en')->nullable();
            $table->date('apply_start')->nullable();
            $table->date('apply_end')->nullable();
            $table->date('course_start')->nullable();
            $table->date('course_end')->nullable();
            $table->integer('seat')->default(20);
            $table->integer('price')->default(0);
            $table->integer('early_price')->nullable();
            $table->integer('member_price')->nullable();
            $table->text('description')->nullable();
            $table->text('remark')->nullable();
            $table->boolean('publish')->default(false);
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
        Schema::dropIfExists('offers');
    }
};
