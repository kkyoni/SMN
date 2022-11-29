<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('int_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->integer('group_id')->length(10)->nullable();
            $table->string('client_name')->length(1000)->nullable();
            $table->tinyInteger('currency')->comment("1=Indian, 2=USD");
            $table->double('amount', 15, 4);
            $table->double('inr_conversation_rate', 15, 4)->nullable();
            $table->double('usd_conversation_rate', 15, 4)->nullable();
            $table->double('aed_amount', 15, 4);
            $table->double('s_aed_amount', 15, 4)->nullable();
            $table->double('s_inr_amount', 15, 4)->nullable();
            $table->double('s_usd_amount', 15, 2)->nullable();
            $table->double('s_usd_inr_amount', 15, 2)->nullable();
            $table->double('usd_amount', 15, 4)->nullable();
            $table->double('inr_amount', 15, 4)->nullable();
            $table->date('created_at');
            $table->char('payment_mode')->length(100)->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('type')->comment("1=Cut,2=Book")->nullable();
            $table->tinyInteger('payment_received')->comment("1=Yes,0=No")->nullable();
            $table->tinyInteger('payment_given')->comment("1=Yes,2=No")->nullable();
            $table->double('opening_balance_inr', 15, 4)->default('0.0000');
            $table->double('opening_balance_aed', 15, 4)->default('0.0000');
            $table->double('opening_balance_usd', 15, 4)->default('0.0000');
            $table->double('closing_balance_inr', 15, 4)->default('0.0000');
            $table->double('closing_balance_aed', 15, 4)->default('0.0000');
            $table->double('closing_balance_usd', 15, 4)->default('0.0000');
            $table->dateTime('created_date_time')->nullable();
            // $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('int_transactions');
    }
}
