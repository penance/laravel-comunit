<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArticleComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->timeStamps();
            $table->integer('user_id')->unsigned();
            $table->integer('article_id')->unsigned();
            $table->text('content');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

            $table->foreign('article_id')
                    ->references('id')
                    ->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comment_user_id_foreign');
            $table->dropForeign('comment_article_id_foreign');
        });

        Schema::drop('comments');
    }
}
