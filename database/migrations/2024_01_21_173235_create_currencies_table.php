<?php

use App\Models\CurrencyType;
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
        Schema::create('currency_accounts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->float('sum');
            $table->string('comment')->nullable();

            $table->foreignIdFor(Direction::class);
            $table->foreignIdFor(CurrencyType::class);

            $table->softDeletes();
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
        Schema::dropIfExists('currency_accounts');
    }
};
