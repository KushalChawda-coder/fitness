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
        Schema::table('leads', function (Blueprint $table) {
            $table->string('here_about_us')->after('profile_image')->nullable();
            $table->string('here_about_description')->after('here_about_us')->nullable();
            $table->string('instagram_url')->after('here_about_description')->nullable();
            $table->string('facebook_url')->after('instagram_url')->nullable();
            $table->string('other_social_link')->after('facebook_url')->nullable();
            $table->string('additional_info')->after('other_social_link')->nullable();
            $table->string('verification_code')->after('additional_info')->nullable();
            $table->timestamp('email_verified_at')->after('verification_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn('here_about_us');
            $table->dropColumn('here_about_description');
            $table->dropColumn('instagram_url');
            $table->dropColumn('facebook_url');
            $table->dropColumn('other_social_link');
            $table->dropColumn('additional_info');
            $table->dropColumn('verification_code');
            $table->dropColumn('email_verified_at');
        });
    }
};
