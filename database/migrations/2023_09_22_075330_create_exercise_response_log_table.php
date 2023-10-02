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
        Schema::create('exercise_response_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('exercise_id')->nullable();
            $table->string('exercise_type')->nullable();
            $table->string('equipments')->nullable();
            $table->string('response_reason')->nullable();
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
        Schema::dropIfExists('exercise_response_log');
    }
};
