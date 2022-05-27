<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_task', function (Blueprint $table) {
            $table->unsignedInteger('task_id');
            $table->unsignedInteger('customer_id');
            $table->primary(['task_id', 'customer_id']);
            $table->date('date')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('customer_task');
    }
}
