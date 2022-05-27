<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('address', 255)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('latitude', 150)->nullable();
            $table->string('longitude', 150)->nullable();
            $table->string('name_contact', 255)->nullable();
            $table->string('email_contact', 255)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('cellphone', 20)->nullable();
            $table->text('website')->nullable();
            $table->integer('active');
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
        Schema::dropIfExists('locations');
    }
}
