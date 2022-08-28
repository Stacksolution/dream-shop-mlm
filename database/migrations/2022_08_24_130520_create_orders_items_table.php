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
        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_produt_id')->nullable();
            $table->bigInteger('item_order_id')->nullable();
            $table->float('item_price',10,2)->nullable();
            $table->float('item_tax',10,2)->nullable();
            $table->string('item_tax_details')->nullable();
            $table->longText('item_details')->nullable();
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
        Schema::dropIfExists('order_items');
    }
};
