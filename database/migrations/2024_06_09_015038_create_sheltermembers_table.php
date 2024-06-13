<?php

use App\Models\Sheltermember;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheltermembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheltermember', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('last_name');
                $table->string('mother_lastname');
                $table->string('phone');
                $table->string('email');
                $table->string('state');
                $table->string('city');
                $table->string('colony');
                $table->string('address');
                $table->string('postal_code');
                $table->enum('typemember', Sheltermember::TYPEMEMBER)->nullable();
                $table->unsignedBigInteger('shelter_id');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('shelter_id')->references('id')->on('shelters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sheltermembers');
    }
}
