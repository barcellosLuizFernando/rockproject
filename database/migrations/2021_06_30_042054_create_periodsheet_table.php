<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodsheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodsheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUser')->constrained('users', 'id');
            $table->dateTime('datetime');
            $table->boolean('flow');
            $table->boolean('adjusted');
            $table->string('description');
            $table->string('ip');
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
        Schema::dropIfExists('periodsheet');
    }
}
