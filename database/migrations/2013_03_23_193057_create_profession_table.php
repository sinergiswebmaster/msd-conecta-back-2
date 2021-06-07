<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProfessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
        });

        $profession = [
            ['name' => 'Médico Especialista/Residente'],
            ['name' => 'Empleado MSD'],
            ['name' => 'Enfermera'],
            ['name' => 'Médico General'],
            ['name' => 'Profesional de la Salud'],            
        ];
        DB::table('professions')->insert($profession);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profession');
    }
}
