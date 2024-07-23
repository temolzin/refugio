<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deaths', function (Blueprint $table) {
            $table->id('death_id');
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('shelter_id')->nullable();
            $table->date('date');
            $table->string('cause')->nullable();

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->foreign('shelter_id')->references('id')->on('shelters')->onDelete('cascade');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deaths');
    }
}
