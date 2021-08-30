<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idSupplier')->constrained('people');
            $table->date('date');
            $table->double('value');
            $table->string('description');
            $table->foreignId('idFinancePlan')->constrained('financeplans');
            //$table->foreignId('idLiablePerson')->constrained('people');
            $table->string('idTransaction', 5)->references('id')->on('transactions');
            $table->string('order')->nullable();
            $table->string('invoicenumber', 45)->nullable();
            $table->string('filename')->nullable();
            $table->foreignId('idUser')->constrained('users');
            $table->foreignId('idUserUpd')->constrained('users');
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
        Schema::dropIfExists('purchases');
    }
}
