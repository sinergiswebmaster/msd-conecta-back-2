<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->dateTime('event_date')->nullable();
            $table->string('playback_id');
            $table->string('translated_playback_id')->nullable();  
            //$table->string('mux_id');
            $table->boolean('publish');
            //$table->string('poster')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['vod','upcoming','live', 'idle', 'fail', 'finished', 'dryrun'] );
            //$table->integer('views')->default(0);
            $table->string('duration')->nullable();
            //$table->bigInteger('favorites')->unsigned()->default(0)->nullable();
            $table->string('survey_typeform_id')->nullable();
            $table->string('exam_typeform_id')->nullable();
            $table->string('redirect')->default(0);

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
        Schema::dropIfExists('events');
    }
}
