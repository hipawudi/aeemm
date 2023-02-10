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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('survey_id');
            $table->integer('sequence')->nullable();
            $table->string('field_name');
            $table->string('title_cn');
            $table->string('title_en')->nullable();
            $table->string('type')->nullable();
            $table->string('option_cn')->default('[]');
            $table->string('option_en')->default('[]');
            $table->boolean('other')->nullable();
            $table->string('other_label')->nullable();
            $table->string('format')->nullable();
            $table->string('rule')->nullable();
            $table->boolean('mandatory')->nullable();
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
        Schema::dropIfExists('questions');
    }
};
