<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUser')->constrained('users','id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('district')->nullable();
            $table->string('adjunct')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthcity')->nullable();
            $table->string('birthstate')->nullable();
            $table->string('maritalstatus')->nullable();
            $table->string('spousename')->nullable();
            $table->string('fathersname')->nullable();
            $table->string('mothersname')->nullable();
            $table->integer('kids')->nullable();
            $table->string('ctps')->nullable();
            $table->date('ctpsdate')->nullable();
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('rgissuer')->nullable();
            $table->string('rgstate')->nullable();
            $table->date('rgdate')->nullable();
            $table->string('militarydoc')->nullable();
            $table->string('militaryserie')->nullable();
            $table->string('militarycategory')->nullable();
            $table->bigInteger('voterdoc')->nullable();
            $table->integer('voterzone')->nullable();
            $table->integer('votersection')->nullable();
            $table->bigInteger('pis')->nullable();
            $table->bigInteger('driverslicense')->nullable();
            $table->string('driverslicensecategory')->nullable();
            $table->date('driverslicensedate')->nullable();
            $table->date('driverslicensedateissue')->nullable();
            $table->date('driverslicensedateexpired')->nullable();
            $table->string('graduation')->nullable();
            $table->string('graduationsituation')->nullable();
            $table->string('graduationstage')->nullable();
            $table->date('admissiondate')->nullable();
            $table->double('salary')->nullable();
            $table->string('jobtime')->nullable();
            $table->string('role')->nullable();
            $table->string('transportticket')->nullable();
            $table->string('transportticketstages')->nullable();
            $table->string('transportticketcompany')->nullable();
            $table->string('experiencetime')->nullable();
            $table->string('jobplace')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('employees');
    }
}
