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
            $table->string('from', 30);
            $table->string('to', 30);
            $table->timestamp('date');
            $table->decimal('price', 8, 2);
            $table->integer('number_of_seats');
            $table->string('airline');
            $table->string('aircraft');
            $table->foreign('from')->references('cityName')->on('cities')->onDelete("cascade");
            $table->foreign('to')->references('cityName')->on('cities')->onDelete("cascade");

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
