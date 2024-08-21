<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bonds', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('ticker');
            $table->double('lots');
            $table->double('price');
            $table->double('coupon')->nullable();//todo можно рассчитать
            $table->double('profit_percent')->nullable();

            $table->double('coupon_percent')->nullable();
            $table->integer('coupon_day_period')->nullable();
            $table->date('expiration_date')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonds');
    }
};
