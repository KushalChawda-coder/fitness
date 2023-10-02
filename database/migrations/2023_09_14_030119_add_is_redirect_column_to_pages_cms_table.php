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
        Schema::table('pages_cms', function (Blueprint $table) {
            $table->boolean('is_redirect')->after('meta_tags')->default(0)->comment('1 = true, 0 = false');
            
            $table->string('redirect_at')->after('meta_tags')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages_cms', function (Blueprint $table) {
            //
        });
    }
};
