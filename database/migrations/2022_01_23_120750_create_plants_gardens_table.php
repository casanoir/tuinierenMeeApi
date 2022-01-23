<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsGardensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants_gardens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plant_id')->references('id')->on('plants')->unique()->notNullable();
            $table->foreignId('garden_id')->references('id')->on('gardens')->unique()->notNullable();
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
        Schema::dropIfExists('plants_gardens');
    }
}
