<?php

use App\Models\Direction;
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
        Schema::table('stocks', function (Blueprint $table) {
            $table->foreignIdFor(Direction::class)->nullable();
        });
        Schema::table('bonds', function (Blueprint $table) {
            $table->foreignIdFor(Direction::class)->nullable();
        });
        Schema::table('cryptos', function (Blueprint $table) {
            $table->foreignIdFor(Direction::class)->nullable();
        });
        Schema::table('funds', function (Blueprint $table) {
            $table->foreignIdFor(Direction::class)->nullable();
        });
        Schema::table('loans', function (Blueprint $table) {
            $table->foreignIdFor(Direction::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('direction_id');
        });
        Schema::table('bonds', function (Blueprint $table) {
            $table->dropColumn('direction_id');
        });
        Schema::table('cryptos', function (Blueprint $table) {
            $table->dropColumn('direction_id');
        });
        Schema::table('funds', function (Blueprint $table) {
            $table->dropColumn('direction_id');
        });
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('direction_id');
        });
    }
};
