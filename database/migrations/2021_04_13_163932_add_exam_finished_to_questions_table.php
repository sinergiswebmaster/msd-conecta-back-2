<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExamFinishedToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->boolean('exam_start')->default(0);
            $table->datetime('exam_start_datetime')->nullable();
            $table->boolean('exam_finished')->default(0);
            $table->datetime('exam_finished_datetime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('exam_start');
            $table->dropColumn('exam_start_datetime');
            $table->dropColumn('exam_finished');
            $table->dropColumn('exam_finished_datetime');
        });
    }
}
