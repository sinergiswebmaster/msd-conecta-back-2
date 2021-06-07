<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();

            $table->time('accumulated_time', 0)->nullable()->default('00:00:00');
            $table->time('progress_time', 0)->nullable()->default('00:00:00');
            $table->time('video_duration', 0)->nullable()->default('00:00:00');
            $table->tinyInteger('percentage')->default(0);
            $table->boolean('has_ended')->default(0); /** 0 = false, 1= true */

            $table->enum('status', ['vod','upcoming','live', 'idle', 'fail', 'finished'] );
            
            $table->enum('device',['móvil','escritorio']); /** 0 = mobile, 1= desktop */
            $table->string('OS');
            $table->string('browser');
            
            $table->dateTime('played_at',0)->useCurrent();
            
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('trackings');
    }
}
