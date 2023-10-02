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
        Schema::create('leads_website', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lead_id');
            $table->integer('domain_id');
            $table->string('brand_name');
            $table->string('brand_logo');
            $table->string('customer_claim_code');
            $table->longText('page_data');
            $table->string('plan_note');
            $table->longText('plan_description');
            $table->string('plan_background_image');
            $table->string('class_note');
            $table->longText('class_description');
            $table->string('class_background_image');
            $table->string('general_info');
            $table->longText('flyer_data');
            $table->string('reason')->nullable();
            $table->boolean('wesite_status')->default(0)->comment('1 = claim, 2 = Not at this time, 3 = please deactivate');
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
        Schema::dropIfExists('leads_website');
    }
};
