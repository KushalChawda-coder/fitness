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
        Schema::create('manage_exercise', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('exercise_name')->nullable();
            $table->string('body_part_ids');
            $table->string('equipments_ids');
            $table->string('exercise_type_ids');
            $table->string('highlight_images')->nullable();
            $table->longText('benefits')->nullable();
            $table->longText('directions')->nullable();
            $table->string('direction_videos')->nullable();
            $table->string('video_link')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_friendly_url')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_tags')->nullable();
            $table->boolean('status')->default(1)->comment('1 = publish, 2 = draft');
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
        Schema::dropIfExists('manage_exercise');
    }
};
