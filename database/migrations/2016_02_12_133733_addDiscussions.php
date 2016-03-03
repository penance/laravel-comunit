<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->text('title');
        });

        Schema::create('discussions', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->text('title');
            $table->longText('proposal');
            $table->integer('user_id')->unsigned();
            $table->integer('status_id')->unsigned();
        });

        Schema::create('consents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discussion_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->boolean('status');
        });

        Schema::create('opinions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('discussion_id')->unsigned()->index();
            $table->boolean('status');
        });

        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->integer('discussion_id')->unsigned()->index();
        });


        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discussion_id')->unsigned()->index();
            $table->integer('option_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });

        // relations
        Schema::table('discussions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('statuses');
        });

        Schema::table('consents', function (Blueprint $table) {
            $table->foreign('discussion_id')->references('id')->on('discussions');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('opinions', function (Blueprint $table) {
            $table->foreign('discussion_id')->references('id')->on('discussions');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('votes', function (Blueprint $table) {
            $table->foreign('discussion_id')->references('id')->on('discussions');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('option_id')->references('id')->on('options');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // remove relations
        Schema::table('discussions', function (Blueprint $table) {
            $table->dropForeign('discussion_user_id_foreign');
            $table->dropForeign('discussion_status_id_foreign');
        });

        Schema::table('consents', function (Blueprint $table) {
            $table->dropForeign('consent_discussion_id_foreign');
            $table->dropForeign('consent_user_id_foreign');
        });

        Schema::table('opinions', function (Blueprint $table) {
            $table->dropForeign('opinion_discussion_id_foreign');
            $table->dropForeign('opinion_user_id_foreign');
        });

        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign('vote_discussion_id_foreign');
            $table->dropForeign('vote_user_id_foreign');
            $table->dropForeign('vote_option_id_foreign');
        });

        // remove tables
        Schema::drop('statuses');
        Schema::drop('discussions');
        Schema::drop('consents');
        Schema::drop('opinions');
        Schema::drop('options');
        Schema::drop('votes');
    }
}
