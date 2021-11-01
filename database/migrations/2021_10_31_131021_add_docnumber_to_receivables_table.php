<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocnumberToReceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receivables', function (Blueprint $table) {
            //
            $table->string('docnumber')->nullable()->after('date');
            $table->integer('idUserUpd')->nullable()->after('idUser');
            $table->string('filename')->nullable()->after('idUserUpd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receivables', function (Blueprint $table) {
            //
            $table->dropColumn('docnumber');
            $table->dropColumn('idUserUpd');
            $table->dropColumn('filename');
        });
    }
}
