<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->string('folio', 255);
            $table->string('name', 255);
            $table->string('email', 255)->nullable();
            $table->string('phone', 15)->nullable();
            $table->date('date_event')->nullable();
            $table->time('hour')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('age', 5)->nullable();
            $table->string('sex', 30)->nullable();
            $table->string('size', 50)->nullable();
            $table->string('category', 100)->nullable();
            $table->string('saturday_entry')->nullable();
            $table->string('sunday_entry')->nullable();
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
        Schema::dropIfExists('buyers');
    }
}
