<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreasuryMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_moves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idBank')->constrained('bank_accounts');
            $table->foreignId('idFinancePlan')->constrained('financeplans');
            $table->string('idTransaction',5);
            $table->date('datemove');
            $table->double('value');
            $table->string('description');
            $table->integer('idPaymentMove')->nullable();
            $table->integer('idReceivableMove')->nullable();
            $table->integer('idTreasuryMove')->nullable();
            $table->foreignId('idPeople')->constrained('people');
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
        Schema::dropIfExists('treasury_moves');
    }
}
