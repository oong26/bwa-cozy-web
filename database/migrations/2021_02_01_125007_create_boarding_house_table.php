<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardingHouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boarding_house', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 50);
            $table->tinyInteger('id_city')->unsigned();
            $table->tinyInteger('id_country')->unsigned();
            $table->string('price', 9);
            $table->string('image',100);
            $table->tinyInteger('rating')->default(0);
            $table->text('address');
            $table->string('phone', 13);
            $table->text('map_url');
            $table->tinyInteger('number_of_kitchens')->default(0);
            $table->tinyInteger('number_of_bathrooms')->default(0);
            $table->tinyInteger('number_of_bedrooms')->default(0);
            $table->tinyInteger('number_of_cupboards')->default(0);
            $table->timestamps();
            $table->foreign('id_city')->references('id')->on('city');
            $table->foreign('id_country')->references('id')->on('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boarding_house');
    }
}
