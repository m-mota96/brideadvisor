<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger('event_type_id');
            $table->foreign('event_type_id')->references('id')->on('event_types');
            $table->unsignedBigInteger('enclosure_id');
            $table->foreign('enclosure_id')->references('id')->on('enclosures');
            $table->string('name', 255);
            $table->string('organized_by', 255)->nullable();
            $table->integer('active')->nullable();
            $table->date('initial_date')->nullable();
            $table->date('final_date')->nullable();
            $table->string('entry_sat', 20)->nullable();
            $table->string('entry_sun', 20)->nullable();
            $table->integer('ticket_price')->nullable();
            $table->string('img_pdf')->nullable();
            $table->string('img_mail')->nullable();
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
        Schema::dropIfExists('events');
    }
}
