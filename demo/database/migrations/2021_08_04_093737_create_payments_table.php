<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id')->length(10)->nullable();
            $table->double('amount', 15, 4);
            $table->string('client_name')->length(1000)->nullable();
            $table->double('opening_balance_inr', 15, 4);
            $table->double('opening_balance_aed', 15, 4);
            $table->double('opening_balance_usd', 15, 4);
            $table->double('closing_balance_inr', 15, 4);
            $table->double('closing_balance_aed', 15, 4);
            $table->double('closing_balance_usd', 15, 4);
            $table->date('created_at');
            $table->dateTime('created_date_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
