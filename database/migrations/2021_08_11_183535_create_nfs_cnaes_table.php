<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNfsCnaesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nfs_cnaes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cityId')->constrained('cities');
            $table->integer('subclasse');
            $table->string('denominacao');
            $table->longText('descricao');
            $table->integer('item');
            $table->integer('subitem');
            $table->double('aliquota');
            $table->date('dtcancelamento')->nullable();
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
        Schema::dropIfExists('nfs_cnaes');
    }
}
