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
        Schema::create('bonanzavalues', function (Blueprint $table) {
            $table->id();
            $table->float('bonanza_value',10,2)->nullable();
            $table->string('bonanza_value_side')->nullable();
            $table->bigInteger('bonanza_user_id')->nullable();
            $table->text('bonanza_description')->nullable();
            $table->boolean('bonanza_type')->default(1);
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
        Schema::dropIfExists('bonanzavalues');
    }
};
