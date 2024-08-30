<?php

use App\Models\Company;
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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Direction::class);
            $table->foreignIdFor(Company::class);

            $table->float('price');
            $table->float('percent');


            $table->string('repayment_schedule_type');
            $table->string('payment_type');
            $table->smallInteger('payment_day')->nullable();
            $table->date('expiration_date');


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
        Schema::dropIfExists('loans');
    }
};
