<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNfsCfpsCstTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nfs_cfps_csts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cityId')->constrained('cities');
            $table->integer('cfps');
            $table->integer('cst');
            $table->integer('cdnfe')->nullable();
            $table->boolean('exibe_cst');
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
        Schema::dropIfExists('nfs_cfps_csts');
    }
}
