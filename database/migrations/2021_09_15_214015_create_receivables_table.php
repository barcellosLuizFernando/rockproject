<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idClient')->constrained('people');
            $table->foreignId('idFinancePlan')->constrained('financeplans');
            $table->string('idTransaction', 5);
            $table->date('date');
            $table->date('duedate');
            $table->double('value');
            $table->string('description')->nullable();
            $table->integer('idSale')->nullable();
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
        Schema::dropIfExists('receivables');
    }
}
