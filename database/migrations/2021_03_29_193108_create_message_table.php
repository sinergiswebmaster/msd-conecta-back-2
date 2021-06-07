<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->text('message');
            $table->tinyInteger('has_support')->default(0);//0 => no, 1=>1
            $table->tinyInteger('mark_read')->default(0);//0 => no, 1=>1
            $table->tinyInteger('to_speaker')->default(0);//0 => no, 1=>1
            $table->foreignId('to_user')->nullable()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('to_message')->unsigned()->nullable();//the message id
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
        Schema::dropIfExists('messages');
    }
}
