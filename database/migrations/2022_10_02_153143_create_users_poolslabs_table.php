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
        Schema::create('users_poolslabs', function (Blueprint $table) {
            $table->id();
            $table->string('slab_name')->nullable();
            $table->string('slab_user_target')->nullable();
            $table->float('slab_amount',10,2)->nullable();
            $table->boolean('slab_completed')->nullable();
            $table->bigInteger('slab_user_id')->nullable();
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
        Schema::dropIfExists('users_poolslabs');
    }
};
