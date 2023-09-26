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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('name_zh');
            $table->string('name_en')->nullable();;
            $table->text('gender')->nullable();;
            $table->text('photo_path')->nullable();
            $table->date('birth')->nullable();;
            $table->string('address')->nullable();;
            $table->string('phone')->nullable();;
            $table->string('email')->nullable();;
            $table->string('company')->nullable();;
            $table->string('position')->nullable();;
            $table->text('membership_level')->default(3);
            $table->text('state')->default(1);
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
        Schema::dropIfExists('members');
    }
};
