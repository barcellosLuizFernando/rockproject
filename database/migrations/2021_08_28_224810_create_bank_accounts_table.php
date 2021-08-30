<?php

use Composer\Package\Version\StabilityFilter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('idBank')->default(0);
            $table->string('agencynumber')->nullable();
            $table->string('accountnumber')->nullable();
            $table->date('startdate');
            $table->double('startvalue');
            $table->string('pixkey')->nullable();
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
        Schema::dropIfExists('bank_accounts');
    }
}
