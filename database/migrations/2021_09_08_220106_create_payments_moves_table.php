<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_moves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPayment')->constrained('payments');
            $table->string('idTransaction',5)->constrained('transactions');
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
        Schema::dropIfExists('payments_moves');
    }
}
