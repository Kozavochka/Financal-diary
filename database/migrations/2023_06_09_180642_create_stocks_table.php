<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('ticker');
            $table->double('price');
            $table->unsignedInteger('lots');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
