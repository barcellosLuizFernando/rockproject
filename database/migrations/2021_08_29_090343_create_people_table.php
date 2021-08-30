<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('taxnumber');
            $table->string('taxtype', 1);
            $table->boolean('client');
            $table->boolean('supplier');
            $table->boolean('employee');
            $table->foreignId('idCity')->constrained('cities');
            $table->string('zipcode')->nullable();
            $table->string('address')->nullable();
            $table->string('district')->nullable();
            $table->string('email')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('cellphonenumber')->nullable();
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
        Schema::dropIfExists('people');
    }
}
