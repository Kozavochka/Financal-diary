<?php

use App\Models\Cash;
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
        Schema::create('change_histories', function (Blueprint $table) {
            $table->id();

            $table->float('sum')->default(0);
            $table->foreignIdFor(Cash::class);
            $table->integer('change_reason_id');
            $table->string('change_reason_type');

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
        Schema::dropIfExists('change_histories');
    }
};
