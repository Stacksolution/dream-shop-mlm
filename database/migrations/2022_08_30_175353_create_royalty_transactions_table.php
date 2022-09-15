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
        Schema::create('royalty_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_transaction_id')->nullable();
            $table->float('transaction_amount',10,2)->nullable();
            $table->bigInteger('transaction_status')->nullable();
            $table->boolean('transaction_settled_status')->default(1);
            $table->string('transaction_mode')->nullable();
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
        Schema::dropIfExists('royalty_transactions');
    }
};
