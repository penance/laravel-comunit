<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConversations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('conversation_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('conversation_id')->unsigned();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('conversation_id')->unsigned();
        });

        Schema::table('messages', function (Blueprint $table){
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');

            $table->foreign('conversation_id')
                  ->references('id')
                  ->on('conversations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table){
            $table->dropForeign('message_user_id_foreign');
            $table->dropForeign('conversation_message_id_foreign');
        });

        Schema::drop('messages');
        Schema::drop('conversations');
        Schema::drop('conversation_user');
    }
}
