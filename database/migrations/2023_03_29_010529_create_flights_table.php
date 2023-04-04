<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_name');
            $table->date('date');
            $table->string('from');
            $table->string('to');
            $table->string('airport');
            $table->string('airline');
            $table->string('aircraft');
            $table->string('image')->default('default.jpg');
            $table->decimal('price', 8, 2);
            $table->integer('number_of_seats');
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
        Schema::dropIfExists('flights');
    }
};
