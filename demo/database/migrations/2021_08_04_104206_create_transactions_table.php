<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('accepted_by')->nullable();
            $table->bigInteger('from_user_id')->nullable();
            $table->bigInteger('to_user_id')->nullable();
            $table->string('from_name')->length(255)->nullable();
            $table->double('from_commission_amount', 15, 2)->nullable();
            $table->double('from_commission', 8, 2)->nullable();
            $table->double('from_current_balance', 15, 2)->nullable();
            $table->double('from_total_balance', 15, 2)->nullable();
            $table->double('from_closing_balance', 15, 2)->nullable();
            $table->double('amount', 15, 2)->nullable();
            $table->string('to_name')->length(255)->nullable();
            $table->double('to_commission_amount', 15, 2)->nullable();
            $table->double('to_commission', 15, 2)->nullable();
            $table->double('to_current_balance', 15, 2)->nullable();
            $table->double('to_total_balance', 15, 2)->nullable();
            $table->double('to_closing_balance', 15, 2)->nullable();
            $table->double('profit', 15, 2)->nullable();
            $table->double('transaction_profit', 15, 2)->nullable();
            $table->string('remarks')->length(255)->nullable();
            $table->string('sender_name')->length(255)->nullable();
            $table->bigInteger('sender_contact')->length(20)->nullable();
            $table->string('receiver_name')->length(255)->nullable();
            $table->bigInteger('receiver_contact')->length(20)->nullable();
            $table->enum('transaction_type',['1', '2', '3', '4'])->default('1')->comment("1=Auto, 2=Manual, 3=Normal");
            $table->enum('status',['1', '2', '3'])->default('1')->comment("1=Placed,2=Approved,3=Rejected");
            $table->timestamps();
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
        Schema::dropIfExists('transactions');
    }
}
