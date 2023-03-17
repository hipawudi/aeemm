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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->restrictOnDelete();
            $table->string('field_name');
            $table->string('field_label');
            $table->string('type')->default('input');
            $table->boolean('required')->default(false);
            $table->string('rule')->nullable();
            $table->string('validate')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('form_fields');
    }
};
