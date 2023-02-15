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
            $table->string('code');
            $table->string('area')->nullable();
            $table->string('category')->nullable();
            $table->string('title_zh');
            $table->string('title_en')->nullable();
            $table->text('description')->nullable();
            $table->integer('price')->default(0);
            $table->integer('early_price')->nullable();
            $table->integer('member_price')->nullable();
            $table->integer('sessions')->nullable();
            $table->integer('hours')->nullable();
            $table->integer('quota')->nullable();
            $table->text('discount')->nullable();
            $table->boolean('valid')->default(true);
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
