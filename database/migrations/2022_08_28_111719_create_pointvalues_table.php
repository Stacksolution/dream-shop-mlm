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
        Schema::create('pointvalues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('point_value')->nullable();
            $table->string('point_value_side')->nullable();
            $table->float('point_value_rate',10,2)->nullable();
            $table->bigInteger('point_user_id')->nullable();
            $table->bigInteger('point_description')->nullable();
            $table->boolean('point_type','0');
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
        Schema::dropIfExists('pointvalues');
    }
};
