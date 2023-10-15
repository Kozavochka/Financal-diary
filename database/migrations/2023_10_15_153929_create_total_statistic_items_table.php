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
        Schema::create('total_statistic_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('total_statistic_id')->constrained('total_statistics')->onDelete('cascade');
            $table->foreignId('direction_id')->constrained('directions')->onDelete('cascade');
            $table->double('sum')->nullable()->default(0);

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
        Schema::dropIfExists('total_statistic_items');
    }
};
