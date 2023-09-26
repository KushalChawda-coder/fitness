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
        Schema::table('landing_page_cms', function (Blueprint $table) {
            $table->string('action_button_name')->nullable()->after('lead_collection_column');
            $table->string('digital_files')->nullable()->after('action_button_name');
            $table->string('landing_page_type')->nullable()->after('digital_files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('landing_page_cms', function (Blueprint $table) {
            $table->dropColumn('action_button_name');
            $table->dropColumn('digital_files');
            $table->dropColumn('landing_page_type');
        });
    }
};
