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
            $table->string('name', 50);
            $table->string('email', 40)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('gender', ['M','F'])->nullable();
            $table->string('password', 60);
            $table->date('birthday')->nullable();
            $table->text('address')->nullable();
            $table->string('phone', 13)->unique()->nullable();
            $table->string('profile_photo_url')->nullable();
            $table->tinyInteger('id_role')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('id_role')->references('id')->on('role');
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
