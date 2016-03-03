<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixDiscuassions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign('votes_discussion_id_foreign');
        });

        Schema::table('votes', function (Blueprint $table) {
            $table->dropColumn('discussion_id');
        });

        Schema::table('discussions', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('consents', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('opinions', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('votes', function (Blueprint $table) {
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
        Schema::table('votes', function (Blueprint $table) {
            $table->foreign('discussion_id')->references('id')->on('discussions');
        });

        Schema::table('discussions', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('consents', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('opinions', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('votes', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
