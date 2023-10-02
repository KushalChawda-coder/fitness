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
        Schema::table('leads_website', function (Blueprint $table) {
            $table->string('brand_bg_color')->nullable()->after('brand_logo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads_website', function (Blueprint $table) {
            $table->dropColumn('brand_bg_color');
        });
    }
};
