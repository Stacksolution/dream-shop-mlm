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
        Schema::create('rewardsvalues', function (Blueprint $table) {
            $table->id();
            $table->float('rewards_value',10,2)->nullable();
            $table->string('rewards_value_side')->nullable();
            $table->float('rewards_value_rate',10,2)->nullable();
            $table->bigInteger('rewards_user_id')->nullable();
            $table->text('rewards_description')->nullable();
            $table->boolean('rewards_type','0');
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
        Schema::dropIfExists('rewardsvalues');
    }
};
