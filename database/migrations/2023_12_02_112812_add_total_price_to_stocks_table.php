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
        Schema::table('stocks', function (Blueprint $table) {
            $table->unsignedDouble('total_price')->after('lots')->nullable();//todo вспомнить почему, вроде где-то для аналитики
        });

        $stocks = \App\Models\Stock::all();
        foreach ($stocks as $stock){
            $stock->update([
                'total_price' => round($stock->price * $stock->lots,2) ?? 0
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('total_price');
        });
    }
};
