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
        Schema::create('landing_page_cms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('main_heading');
            $table->string('menu_text');
            $table->string('brand_name')->nullable();
            $table->string('service_name')->nullable();
            $table->string('app_name')->nullable();
            $table->string('banner_image');
            $table->string('bar_text')->nullable();
            $table->string('sub_text')->nullable();
            $table->longText('lead_collection')->nullable();
            $table->longText('lead_collection_column')->nullable();
            $table->string('meta_page_title')->nullable();
            $table->string('meta_friendly_url')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_tags')->nullable();
            $table->integer('domain_id')->unique();
            $table->boolean('status')->default(1)->comment('1 = publish, 2 = draft');
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('landing_page_cms');
    }
};
