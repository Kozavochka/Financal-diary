<?php

use App\Models\Direction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Direction::class);

            $table->string('name');
            $table->string('ticker');
            $table->double('price');
            $table->unsignedInteger('lots');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
