<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courseclasses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idCompany')->constrained('companies');
            $table->foreignId('idClassLocal')->constrained('classlocals');
            $table->foreignId('idCourse')->constrained('courses');
            $table->string('name')->nullable();
            $table->integer('rock_id')->nullable();
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
        Schema::dropIfExists('courseclasses');
    }
}
