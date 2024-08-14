<?php

use App\Models\Direction;
use App\Models\Industry;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Direction::class)->nullable();
            $table->foreignIdFor(Industry::class)->nullable();

            $table->string('name');
            $table->string('ticker');
            $table->float('price');
            $table->float('lots');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
