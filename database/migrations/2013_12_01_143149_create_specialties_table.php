<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        $specialties = [
            ['name' => 'Cirugía Oncológica'],
	        ['name' => 'Oncología'],
            ['name' => 'Radiología'],
            ['name' => 'Radio-Oncología'],
            ['name' => 'Alergología'],
            ['name' => 'Anestesiología'],
            ['name' => 'Cardiología'],
            ['name' => 'Cirugía'],
            ['name' => 'Dermatología'],
            ['name' => 'Endocrinología'],
            ['name' => 'Enfermería'],
            ['name' => 'Gastroenterología'],
            ['name' => 'Geriatría'],
            ['name' => 'Ginecología y Obstetricia'],
            ['name' => 'Hematología'],
            ['name' => 'Hepatología'],
            ['name' => 'Infectología'],
            ['name' => 'Inmunología'],
            ['name' => 'Intensivista'],
            ['name' => 'Medicina del Deporte'],
            ['name' => 'Medicina Familiar'],
            ['name' => 'Medicina Física y Rehabilitación'],
            ['name' => 'Medicina General'],
            ['name' => 'Medicina Interna'],
            ['name' => 'Medicina Vascular'],
            ['name' => 'Nefrología'],
            ['name' => 'Neumología'],
            ['name' => 'Neurología'],
            ['name' => 'Odontología'],
            ['name' => 'Oftalmología'],
            ['name' => 'Otorrinolaringología y Cirugía de Cabeza y Cuello'],
            ['name' => 'Otras'],
            ['name' => 'Patología Clínica'],
            ['name' => 'Pediatría'],
            ['name' => 'Psiquiatría'],
            ['name' => 'Reumatología'],
            ['name' => 'Salud Pública'],
            ['name' => 'Traumatología y Ortopedia'],
            ['name' => 'Urología'],
            ['name' => 'No Aplica']

        ];
        DB::table('specialties')->insert($specialties);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialties');
    }
}
