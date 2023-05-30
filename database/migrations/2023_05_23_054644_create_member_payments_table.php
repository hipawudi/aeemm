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
        Schema::create('member_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id');
            $table->integer('cost');
            $table->integer('cost_percentage')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->text('remark')->nullable();
            $table->text('return_remark')->nullable();
            $table->text('payment_image_path')->nullable();
            $table->integer('state');
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
        Schema::dropIfExists('member_payments');
    }
};
