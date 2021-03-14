<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_photos', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('id_boarding_house')->unsigned();
            $table->string('image', 100);
            $table->foreign('id_boarding_house')->references('id')->on('boarding_house');
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
        Schema::dropIfExists('house_photos');
    }
}
