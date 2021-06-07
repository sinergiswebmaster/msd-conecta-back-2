<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();

            $table->foreignId('profession_id')->references('id')->on('professions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('specialty_id')->references('id')->on('specialties')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('license')->nullable();
            $table->string('phone')->nullable();

            $table->tinyInteger('role')->default(0);

            $table->timestamps();
        });

        $users = [
          [
              'name' => 'Fernando',
              'last_name' => 'Ramirez',
              'email' => 'fernando.ramirez@sinergis.com.mx',

              'profession_id' => 2,
              'specialty_id' => 3,
              
              'license' => '1221jsdn2',
              'phone' => '55 5127 0868'
           ],

        ];
        DB::table('users')->insert($users);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
