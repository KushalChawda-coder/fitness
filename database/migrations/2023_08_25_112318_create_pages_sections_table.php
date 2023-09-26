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
        Schema::create('pages_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('page_cms_id');
            $table->string('section_id')->nullable();
            $table->longText('page_section_data')->nullable();
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
        Schema::dropIfExists('pages_sections');
    }
};
