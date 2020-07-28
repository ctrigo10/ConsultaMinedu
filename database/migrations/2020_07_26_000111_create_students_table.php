<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('ci');
            $table->string('complement')->nullable();
            $table->string('full_name');
            //$table->string('first_name')->nullable();
            //$table->string('second_name')->nullable();
            //$table->string('lastname')->nullable();
            //$table->string('second_lastname')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('scholarship');
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
        Schema::dropIfExists('students');
    }
}
