<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specie_id');
            $table->unsignedBigInteger('Shelter_id')->nullable();
            $table->string('animal_name');
            $table->string('breed')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('sex', ['Macho', 'Hembra'])->nullable();
            $table->string('color')->nullable();
            $table->decimal('weight')->nullable();
            $table->enum('is_sterilized', ['Si', 'No'])->nullable();
            $table->date('entry_date')->nullable();
            $table->enum('origin', ['Rescatado', 'Transferido', 'Abandonado'])->nullable();
            $table->enum('behavior', ['Amigable', 'Timido', 'Agresivo'])->nullable();
            $table->string('history')->nullable();
            $table->softDeletes();

            $table->foreign('specie_id')->references('id')->on('species')->onDelete('cascade');
            $table->foreign('Shelter_id')->references('id')->on('shelters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
