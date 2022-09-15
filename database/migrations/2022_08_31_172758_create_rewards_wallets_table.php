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
        Schema::create('rewards_wallets', function (Blueprint $table) {
            $table->id();
            $table->float('wallet_amount',10,2)->nullable();
            $table->boolean('wallet_type')->default(0);
            $table->bigInteger('wallet_user_id')->nullable();
            $table->string('wallet_description')->nullable();
            $table->boolean('wallet_status')->default(0);
            $table->string('wallet_transaction_id')->nullable();
            $table->string('wallet_uses')->nullable();
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
        Schema::dropIfExists('rewards_wallets');
    }
};
