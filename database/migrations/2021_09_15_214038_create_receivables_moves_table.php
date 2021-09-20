<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivablesMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivables_moves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idReceivable')->constrained('receivables');
            $table->string('idTransaction', 5);
            $table->date('datemove');
            $table->double('value');
            $table->double('interest')->nullable();
            $table->double('fine')->nullable();
            $table->double('discount')->nullable();
            $table->foreignId('idUser')->constrained('users');
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
        Schema::dropIfExists('receivables_moves');
    }
}
