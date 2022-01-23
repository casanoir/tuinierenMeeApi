<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('firstName')->notNullable();
            $table->string('lastName')->notNullable();
            $table->string('email')->unique()->notNullable();
            $table->string('phone_nummer')->nullable();
            $table->string('password')->notNullable();
            $table->enum('roles', ['baas','assistent','verantwoordelijke','bezoeker'])->default('baas');
            $table->string('avatar')->nullable();
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
        Schema::dropIfExists('users');
    }
}
