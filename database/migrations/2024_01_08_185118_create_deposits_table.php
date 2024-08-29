<?php

use App\Enums\DepositTypeEnum;
use App\Models\Bank;
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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Direction::class);

            $table->foreignIdFor(Bank::class);

            $table->string('type')->default(DepositTypeEnum::deposit()->value);
            $table->double('price');
            $table->double('percent');
            $table->date('expiration_date')->nullable();


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
        Schema::dropIfExists('deposits');
    }
};
