<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupClosingBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_closing_balances', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id')->length(10);
            $table->double('closing_balance_inr', 15, 4)->nullable();
            $table->double('closing_balance_aed', 15, 4)->nullable();
            $table->double('closing_balance_usd', 15, 4)->nullable();
            $table->date('closing_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_closing_balances');
    }
}
