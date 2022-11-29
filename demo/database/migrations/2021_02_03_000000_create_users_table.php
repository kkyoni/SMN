<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by')->length(20)->nullable();
            $table->tinyInteger('user_type_id')->length(3)->default('2')->comment("1=Admin, 2=User");
            $table->string('name')->length(255);
            $table->string('code')->length(255);
            $table->string('username')->length(255);
            $table->string('password')->length(255);
            $table->string('address')->length(255)->nullable();
            $table->string('city')->length(255)->nullable();
            $table->bigInteger('phone_number')->length(20)->nullable();
            $table->double('sender_commission', 8, 2)->nullable();
            $table->double('receiving_commission', 8, 2)->nullable();
            $table->double('limit', 15, 2)->nullable();
            $table->double('current_balance', 15, 2)->default('0.00')->nullable();
            $table->string('image')->length(100)->default('default.png')->nullable();
            $table->string('api_token')->length(255)->nullable();
            $table->tinyInteger('status')->length(3)->default('1')->comment("1=Active,2=Inactive")->nullable();
            $table->tinyInteger('is_head_office')->default('0')->comment("1=Yes,0=No")->nullable();
            $table->tinyInteger('device_type')->comment("1=Android,2=IOS")->nullable();
            $table->tinyInteger('is_verified')->default('0')->comment("1=Verified,0=Not Verified")->nullable();
            $table->string('device_token')->length(1000)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
